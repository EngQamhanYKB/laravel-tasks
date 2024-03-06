<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'budget_pk';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['budget_pk','customer_id','customer_type_id'];
    protected $casts = [
        'wallet_fks' => 'array',
        'budget_transaction_filters' => 'array',
        'member_transaction_filters' => 'array'
    ];}
