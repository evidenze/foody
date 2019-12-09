<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'vendor_id', 'product_id', 'quantity', 'amount', 'address'
    ];

}
