<?php

namespace App\Data;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

class GeneralResponseData extends Data
{
    public StatusData $status;
    public static function prepareForPipeline(array $properties) : array
    {
        if(!Arr::has($properties,"status")){
            $properties["status"] =$properties;
        }
        return $properties;
    }
}
