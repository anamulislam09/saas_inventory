<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'purchase_id',
        'product_id',
        'product_type_id',
        'quantity',
        'unit_price',
        'total_amount',
    ];
    
    public function item()
    {
        return $this->belongsTo(Item::class, 'product_id')->with('unit');
    }
}
