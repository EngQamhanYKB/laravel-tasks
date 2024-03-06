<?php

namespace App\Data;

use Illuminate\Support\Arr;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Str;

#[MapOutputName(SnakeCaseMapper::class)]

class BudgetData extends Data
{
    public string $budgetPk;
    public string $name;
    public int $amount;
    public ?string $colour;
    public int $startDate;
    public int $endDate;
    public array $walletFks;
    public ?string $categoryFks;
    public ?string $categoryFksExclude;
    public bool $income;
    public bool $archived;
    public bool $addedTransactionsOnly;

    public int $periodLength;
    public int $reoccurrence;
    public int $dateCreated;
    public int $dateTimeModified;
    public bool $pinned;
    public int $order;

    public string $walletFk;
    public array $budgetTransactionFilters;
    public ?array $memberTransactionFilters;

    public ?string $sharedKey;
    public ?string $sharedOwnerMember;
    public ?string $sharedDateUpdated;
    public ?string $sharedMembers;
    public ?string $sharedAllMembersEver;
    public bool $isAbsoluteSpendingLimit;
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
