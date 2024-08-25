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
        'vendor_id',
        'vouchar_no',
        'purchase_id',
        'date',
        'total_return_amount',
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
}
