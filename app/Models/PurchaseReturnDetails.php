<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturnDetails extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'vendor_id',
        'vouchar_no',
        'purchase_return_id',
        'product_id',
        'quantity_returned',
        'return_reason',
        'unit_price',
        'amount',
        'created_by_id',
        'updated_by_id',
    ];
}
