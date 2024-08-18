<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'supplier_id',
        'vouchar_no',
        'date',
        'total_price',
        'discount',
        'vat_tax',
        'total_payable',
        'paid_amount',
        'note',
        'payment_status',
        'status',
        'created_by_id',
        'updated_by_id',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'purchase_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function purchase_details()
    {
        return $this->hasMany(PurchaseDetails::class, 'purchase_id')->with('item');
    }
}
