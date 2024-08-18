<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequisitionDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'purchase_requisition_id',
        'item_id',
        'item_type_id',
        'quantity',
        'unit_price',
        'amount',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
