<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;
use Illuminate\Support\Collection;
use Laravel\Telescope\EntryType;
class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        Telescope::tag(function (IncomingEntry $entry) {
            $tags=[];
            if($entry->isRequest()){
                $tags[]=$entry->content["method"]??"";
                $tags[]=$entry->content["uri"]??"";
                if($entry->isFailedRequest()){
                    $tags[]='error';
                }
            }else if($entry->isClientRequest()){
                if(($entry->content['duration']?? 0)>5000){
                    $tags[]='slow';
                }else if(($entry->content['response_status'] ?? 1000)>=500){
                    $tags[]='error';
                }
            }
            return $tags;
        });
        Telescope::filterBatch(function (Collection $entries) {
            //return true;
            if ($this->app->environment('local')) {
                return true;
            }

            return $entries->contains(function (IncomingEntry $entry) {
                return
                    (
                        $entry->isRequest() && (
                            ($entry->content['duration'] ?? 0)>10000 ||
                            ($entry->content['method'] ?? 'GET')!='GET' //||
                            //($entry->content['uri']??"")=="/api/v2/"
                        )
                    )||
                   (
                       $entry->isClientRequest() && (
                           ($entry->content['duration'] ?? 0)>5000 ||
                           (
                               ($entry->content['response_status'] ?? 1000)>=300 &&
                                    !str_starts_with(($entry->content['uri']??""),'https://cardvip')
                            )
                       )
                   )||
                    $entry->isReportableException() ||
                    $entry->isFailedRequest() ||
                    $entry->isFailedJob() ||
                    $entry->isScheduledTask() ||
                    $entry->isSlowQuery() ||
                    $entry->hasMonitoredTag()||
                    $entry->type==EntryType::COMMAND;
                });
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return true;
            // return in_array($user->email, [
            //     //
            // ]);
        });
    }
}
