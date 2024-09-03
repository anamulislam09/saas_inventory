<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'supplier_id',
        'vouchar_no',
        'purchase_id',
        'date',
        'total_return_amount',
        'refund_amount',
        'note',
        'return_status',
        'status',
        'created_by_id',
        'updated_by_id'
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function purchase_return_details()
    {
        return $this->hasMany(PurchaseReturnDetails::class, 'purchase_return_id')->with('product');
    }
}
