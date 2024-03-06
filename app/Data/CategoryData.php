<?php

namespace App\Data;

use Illuminate\Support\Arr;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Str;
#[MapOutputName(SnakeCaseMapper::class)]

class CategoryData extends Data
{
    public string $categoryPk;
    public string $name;
    public ?string $colour;
    public ?string $iconName;
    public ?string $emojiIconName;

    public int $dateCreated;
    public int $dateTimeModified;
    public int $order;
    public bool $income;

    public ?string $methodAdded;
    public ?string $mainCategoryPk;
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
