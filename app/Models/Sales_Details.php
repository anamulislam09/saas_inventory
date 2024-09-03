<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_Details extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'sales_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_amount'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('unit');
    }
}
