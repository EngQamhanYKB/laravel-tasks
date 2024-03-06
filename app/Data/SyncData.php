<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Normalizers\ObjectNormalizer;
use Spatie\LaravelData\DataCollection;

class SyncData extends Data
{
    public ?SyncDatesData $walletDates;
    #[DataCollectionOf(WalletData::class)]
    public DataCollection $wallets;
    public ?SyncDatesData $budgetDates;
    #[DataCollectionOf(BudgetData::class)]
    public DataCollection $budgets;
    public ?SyncDatesData $objectiveDates;
    public array $objectives;
    public ?SyncDatesData $transactionDates;
    #[DataCollectionOf(TransactionData::class)]
    public DataCollection $transactions;
    public ?SyncDatesData $categoryBudgetLimitDates;
    public array $categoryBudgetLimits;
    public ?SyncDatesData $categoryDates;
    #[DataCollectionOf(CategoryData::class)]
    public DataCollection $categories;
    public ?SyncDatesData $associatedTitleDates;
    public array $associatedTitles;
    public ?SyncDatesData $deleteLogDates;
    #[DataCollectionOf(DeleteLogData::class)]
    public DataCollection $deleteLogs;

}
