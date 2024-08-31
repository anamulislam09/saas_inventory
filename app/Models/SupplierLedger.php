<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierLedger extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'supplier_id',
        'purchase_id',
        'sales_id',
        'payment_id',
        'particular',
        'date',
        'debit_amount',
        'credit_amount',
        'note',
        'status',
        'created_by_id',
        'updated_by_id',
    ];
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
