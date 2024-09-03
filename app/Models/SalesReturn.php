<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'vendor_id',
        'invoice_no',
        'sales_id',
        'date',
        'total_amount',
        'refund_amount',
        'note',
        'return_status',
        'status',
        'created_by_id',
        'updated_by_id'
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function sales_return_details()
    {
        return $this->hasMany(SalesReturnDetails::class, 'sales_return_id')->with('product');
    }
}
