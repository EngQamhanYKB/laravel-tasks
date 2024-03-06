<?php

namespace App\Data;

use Illuminate\Support\Arr;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Str;
#[MapOutputName(SnakeCaseMapper::class)]
class BaseData extends Data
{

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

    public function toCamel(array $properties) : array
    {
        $arrays=$this->toArray();
        $result=[];
        foreach ($arrays as $key=>$value) {
            $feild=Str::camel($key);
            $result["{$feild}"] = $value;
        }
        return $result;
    }
}
