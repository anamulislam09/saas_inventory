<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'order_id',
        'item_id',
        'quantity',
        'unit_price',
        'status',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    
}
