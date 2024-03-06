<?php

namespace App\Data;

use Illuminate\Support\Arr;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Str;
#[MapOutputName(SnakeCaseMapper::class)]

class DeleteLogData extends Data
{
    public string $deleteLogPk;
    public string $entryPk;
    public int $type;
    public int $dateTimeModified;
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
