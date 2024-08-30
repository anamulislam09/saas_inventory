<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'vendor_id',
        'invoice_no',
        'date',
        'sales_price',
        'discount_method',
        'discount_rate',
        'discount',
        'vat_tax',
        'receiveable_amount',
        'receive_amount',
        'note',
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
    public function sales_details()
    {
        return $this->hasMany(Sales_Details::class, 'sales_id')->with('product');
    }
}
