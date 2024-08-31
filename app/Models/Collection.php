<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'client_id',
        'vendor_id',
        'collection_method_id',
        'sales_id',
        'date',
        'amount',
        'discount',
        'vat',
        'total_collection_amount',
        'total_collection',
        'note',
        'status',
        'created_by_id',
        'updated_by_id'
    ];
}
