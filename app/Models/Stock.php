<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'product_id',
        'date',
        'stock_quantity',
        'created_by_id',
        'updated_date',
    ];
}
