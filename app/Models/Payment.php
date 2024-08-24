<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'vendor_id',
        'payment_method_id',
        'purchase_id',
        'date',
        'amount',
        'note',
        'status',
        'created_by_id',
        'updated_by_id',
    ];
    public function supplier()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
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
