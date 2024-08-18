<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequisition extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'vouchar_no',
        'date',
        'total_price',
        'note',
        'status',
        'created_by_id',
        'updated_by_id',
    ];
    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function prdetails()
    {
        return $this->hasMany(PurchaseRequisitionDetails::class, 'purchase_requisition_id');
    }
}
