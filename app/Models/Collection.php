<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'order_id',
        'order_no',
        'table_id',
        'payment_method_id',
        'total_amount',
        'total_payable',
        'discount',
        'tax',
        'paid_amount',
        'note',
        'payment_status',
        'created_by_id',
        'approved_by_id',
    ];
}
