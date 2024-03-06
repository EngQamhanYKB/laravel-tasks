<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class MessageData extends Data
{
    public ?string $title;
    public ?string $detail;
    public ?string $code;
    public ?string $type;

}

