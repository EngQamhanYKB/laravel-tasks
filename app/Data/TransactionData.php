<?php

namespace App\Data;

use Illuminate\Support\Arr;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Str;
#[MapOutputName(SnakeCaseMapper::class)]

class TransactionData extends Data
{
    public string $transactionPk;
    public ?string $pairedTransactionFk;
    public ?string $name;
    public ?float $amount;
    public ?string $note;
    public string $categoryFk;
    public ?string $subCategoryFk;
    public string $walletFk;

    public int $dateCreated;
    public int $dateTimeModified;
    public int $originalDateDue;

    public bool $income;

    public ?int $periodLength;
    public ?int $reoccurrence;
    //public ?bool $pinned;
    //public ?int $order;

    public ?int $endDate;
    public bool $upcomingTransactionNotification;
    public ?string $type;
    public bool $paid;
    public bool $createdAnotherFutureTransaction;
    public bool $skipPaid;
    public ?string $methodAdded;
    public ?string $transactionOwnerEmail;
    public ?string $transactionOriginalOwnerEmail;

    public ?string $sharedKey;
    public ?string $sharedOldKey;
    public ?string $sharedStatus;
    public ?string $sharedDateUpdated;
    public ?string $sharedReferenceBudgetPk;
    public ?string $objectiveFk;
    public ?string $objectiveLoanFk;
    public ?string $budgetFksExclude;
    public bool $synced;

    public static function prepareForPipeline(array $properties) : array
    {

        $reflect = new ReflectionClass(static::class);
        $props = $reflect->getProperties();
        $ownProps = [];
        foreach ($props as $prop) {
           // Array::get();
            $feild=$prop->getName();
            $properties["{$feild}"] = Arr::get($properties,"{$feild}",Arr::get($properties,Str::snake("$feild"),null));
        }

        return $properties;
    }
}
