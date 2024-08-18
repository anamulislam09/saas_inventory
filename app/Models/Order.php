<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = 
    [
        'table_id',
        'order_no',
        'trade_price',
        'mrp',
        'discount',
        'vat',
        'net_bill',
        'paid_amount',
        'profit',
        'note',
        'payment_status',
        'order_status',
        'order_type',
        'created_by_id',
        'approved_by_id',
        'received_by_id',
        'created_at',
        'approved_at',
        'processed_at',
        'completed_at',
        'kitchen_alert',
        'collection_alert',
    ];
    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id')->with('item');
    }
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
    public function orderCreatedBy()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
}
