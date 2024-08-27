<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueItemDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'issue_id',
        'item_id',
        'quantity',
        'unit_price',
        'total_amount',
    ];
    public function product()
    {
        return $this->belongsTo(product::class, 'item_id')->with('unit');
    }
}
