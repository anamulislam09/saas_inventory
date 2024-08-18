<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueItem extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'invoice_no',
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
    public function issue_item_details()
    {
        return $this->hasMany(IssueItemDetails::class, 'issue_id')->with('item');
    }
}
