<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class StatusData extends Data
{
    public string $result;
    public string $contextID;
    public MessageData $message;
}
