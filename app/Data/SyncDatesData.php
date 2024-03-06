<?php
namespace App\Data;

use Illuminate\Support\Arr;
use ReflectionClass;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Str;

#[MapOutputName(SnakeCaseMapper::class)]
class SyncDatesData extends Data
{
    public function __construct(
        public ?int $createdAt=1000000000000,
        public ?int $updatedAt=1000000000000,
   ) {
    }
}
