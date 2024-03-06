<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'wallet_pk';
    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['wallet_pk','customer_id','customer_type_id'];
    protected $casts = [
        'home_page_widget_display' => 'array'
    ];
}
