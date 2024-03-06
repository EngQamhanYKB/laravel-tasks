<?php

namespace App\Data;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Routing\ResponseFactory as BaseResponseFactory;
use Illuminate\Support\Str;

class JsonCamel
{

    public static function json($data = array(), $status = 200, array $headers = array(), $options = 0)
    {
        $json = static::encodeJson($data);
        return response()->json($json, $status, $headers, $options);
    }

    /**
     * Encode a value to camelCase JSON
     */
    public static function encodeJson($value)
    {
        if ($value instanceof Arrayable) {
            return static::encodeArrayable($value);
        } else if (is_array($value)) {
            return static::encodeArray($value);
        } else if (is_object($value)) {
            return static::encodeArray((array) $value);
        } else {
            return $value;
        }
    }

    /**
     * Encode a arrayable
     */
    public static function encodeArrayable($arrayable)
    {
        $array = $arrayable->toArray();
        return static::encodeJson($array);
    }

    /**
     * Encode an array
     */
    public static function encodeArray($array)
    {
        $newArray = [];
        foreach ($array as $key => $val) {
            $newArray[Str::camel($key)] = static::encodeJson($val);
        }
        return $newArray;
    }
}
