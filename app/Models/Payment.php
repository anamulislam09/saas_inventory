<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'order_id',
        'order_no',
        'table_id',
        'payment_method_id',
        'total_amount',
        'discount',
        'vat',
        'total_payable',
        'paid_amount',
        'note',
        'payment_status',
        'created_by_id',
        'approved_by_id',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
