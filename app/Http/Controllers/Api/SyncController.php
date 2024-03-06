<?php

namespace App\Http\Controllers\Api;

use App\Data\BudgetData;
use App\Data\CategoryData;
use App\Data\DeleteLogData;
use App\Data\GeneralResponseData;
use App\Data\JsonCamel;
use App\Data\SyncData;
use App\Data\TransactionData;
use App\Data\WalletData;
use App\Enums\LogTypeEnum;
use App\Models\Budget;
use App\Models\Category;
use App\Models\DeleteLog;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;
use Throwable;

class SyncController extends BaseController
{
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $customerId='0183415';
        $customerType=1;

        $syncData=SyncData::from($request->all());
       // return response()->json( $syncData);

        $returnedSyncData=new SyncData;

        foreach ($syncData->deleteLogs as $_deleteLog) {
            $deleteLog=DeleteLog::firstOrNew([
                'delete_log_pk'         => $_deleteLog->deleteLogPk,
                'customer_id'       => $customerId,
                'customer_type_id'  => $customerType
            ]);
            if(!$deleteLog->exist || ($deleteLog->exist && $deleteLog->date_time_modified<$_deleteLog->dateTimeModified)){
                $deleteLog->customer_id=$customerId;
                $deleteLog->customer_type_id=$customerType;
                foreach ($_deleteLog->toArray() as $key => $value) {
                    $deleteLog->{"$key"}=$value;
                }
                $deleteLog->save();
            }

        }

        $deleteLogs=DeleteLog::where('customer_id',$customerId)
        ->where('customer_type_id',$customerType)
        ->where('date_time_modified', '>', $syncData->deleteLogDates->updatedAt)
        ->get();

        $returnedSyncData->deleteLogs=DeleteLogData::collect($deleteLogs, DataCollection::class);

        $wallets=Wallet::where('customer_id',$customerId)
        ->where('customer_type_id',$customerType)
        ->where(function ($query) use ($syncData) {
            $query->where('date_created', '>', $syncData->walletDates->createdAt)
                ->orWhere('date_time_modified','>',$syncData->walletDates->updatedAt);
        })
        ->whereNotIn("wallet_pk",function ($query) use ($syncData,$customerId,$customerType) {
            $query->select('entry_pk')
            ->from('delete_logs')
            ->where('customer_id',$customerId)
            ->where('customer_type_id',$customerType)
            ->where('type',LogTypeEnum::Wallet->value);
            //->where('date_time_modified', '>', $syncData->deleteLogDates->updatedAt);
        })
        ->get();
        // return response()->json($wallets);

        $returnedSyncData->wallets=WalletData::collect($wallets, DataCollection::class);

        $budgets=Budget::where('customer_id',$customerId)
        ->where('customer_type_id',$customerType)
        ->where(function ($query) use ($syncData) {
            $query->where('date_created', '>', $syncData->budgetDates->createdAt)
                ->orWhere('date_time_modified','>',$syncData->budgetDates->updatedAt);
        })
        ->whereNotIn("budget_pk",function ($query) use ($syncData,$customerId,$customerType) {
            $query->select('entry_pk')
            ->from('delete_logs')
            ->where('customer_id',$customerId)
            ->where('customer_type_id',$customerType)
            ->where('type',LogTypeEnum::Budget->value);
            //->where('date_time_modified', '>', $syncData->deleteLogDates->updatedAt);
        })
        ->get();

        $returnedSyncData->budgets=BudgetData::collect($budgets, DataCollection::class);

        $categories=Category::where('customer_id',$customerId)
        ->where('customer_type_id',$customerType)
        ->where(function ($query) use ($syncData) {
            $query->where('date_created', '>', $syncData->categoryDates->createdAt)
                ->orWhere('date_time_modified','>',$syncData->categoryDates->updatedAt);
        })
        ->whereNotIn("category_pk",function ($query) use ($syncData,$customerId,$customerType) {
            $query->select('entry_pk')
            ->from('delete_logs')
            ->where('customer_id',$customerId)
            ->where('customer_type_id',$customerType)
            ->where('type',LogTypeEnum::Category->value);
            //->where('date_time_modified', '>', $syncData->deleteLogDates->updatedAt);
        })
        ->get();

        $returnedSyncData->categories=CategoryData::collect($categories, DataCollection::class);

        $transactions=Transaction::where('customer_id',$customerId)
        ->where('customer_type_id',$customerType)
        ->where(function ($query) use ($syncData) {
            $query->where('date_created', '>', $syncData->transactionDates->createdAt)
                ->orWhere('date_time_modified','>',$syncData->transactionDates->updatedAt);
        })
        ->whereNotIn("transaction_pk",function ($query) use ($syncData,$customerId,$customerType) {
            $query->select('entry_pk')
            ->from('delete_logs')
            ->where('customer_id',$customerId)
            ->where('customer_type_id',$customerType)
            ->where('type',LogTypeEnum::Transaction->value);
            //->where('date_time_modified', '>', $syncData->deleteLogDates->updatedAt);
        })
        ->get();

        $returnedSyncData->transactions=TransactionData::collect($transactions, DataCollection::class);

        return JsonCamel::json($returnedSyncData);
        //return response()->json( $returnedSyncData);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ?\Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {


        $customerId='0183415';
        $customerType=1;

        $syncData=SyncData::from($request->all());

        dispatch(function () use ($syncData,$customerId,$customerType) {
            foreach ($syncData->wallets as $_wallet) {
                $wallet=Wallet::firstOrNew([
                    'wallet_pk'         => $_wallet->walletPk,
                    'customer_id'       => $customerId,
                    'customer_type_id'  => $customerType
                ]);
                if(!$wallet->exist || ($wallet->exist && $wallet->date_time_modified<$_wallet->dateTimeModified)){
                    $wallet->customer_id=$customerId;
                    $wallet->customer_type_id=$customerType;
                    foreach ($_wallet->toArray() as $key => $value) {
                        $wallet->{"$key"}=$value;
                    }
                    $wallet->save();
                }

            }

            foreach ($syncData->budgets as $_budget) {
                $budget=Budget::firstOrNew([
                    'budget_pk'     => $_budget->budgetPk,
                    'customer_id'    => $customerId,
                    'customer_type_id'    => $customerType
                ]);
                if(!$budget->exist || ($budget->exist && $budget->date_time_modified<$_budget->dateTimeModified)){
                    $budget->customer_id=$customerId;
                    $budget->customer_type_id=$customerType;
                    foreach ($_budget->toArray() as $key => $value) {
                        $budget->{"$key"}=$value;
                    }
                    $budget->save();
                }


            }

            foreach ($syncData->categories as $_category) {
                $category=Category::firstOrNew([
                    'category_pk'     => $_category->categoryPk,
                    'customer_id'    => $customerId,
                    'customer_type_id'    => $customerType
                ]);
                if(!$category->exist || ($category->exist && $category->date_time_modified<$_category->dateTimeModified)){
                    $category->customer_id=$customerId;
                    $category->customer_type_id=$customerType;

                    foreach ($_category->toArray() as $key => $value) {
                        $category->{"$key"}=$value;
                    }
                    $category->save();
                }

            }

            foreach ($syncData->transactions as $_transaction) {
                $transaction=Transaction::firstOrNew([
                    'transaction_pk'     => $_transaction->transactionPk,
                    'customer_id'    => $customerId,
                    'customer_type_id'    => $customerType
                ]);
                if(!$transaction->exist || ($transaction->exist && $transaction->date_time_modified<$_transaction->dateTimeModified)){
                    $transaction->customer_id=$customerId;
                    $transaction->customer_type_id=$customerType;
                    foreach ($_transaction->toArray() as $key => $value) {
                        $transaction->{"$key"}=$value;
                    }
                    $transaction->save();
                }
            }
        })->catch(function (Throwable $e) {
            \Log::error("[Notifications]: dispatch send unicast");
        });



        return response()->json(GeneralResponseData::from(array(
            'status'=>[
                "result"    => "SUCCESSFUL",
                "contextID" => "",
                "message"   => [
                    "title"   => "",
                    "detail"  => "",
                    "code"    => "0",
                    "type"    => "INFO"
                ]
            ]
        )));
    }
}
