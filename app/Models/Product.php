<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'cat_type_id',
        'cat_id',
        'sub_cat_id',
        'unit_id',
        'title',
        'description',
        'image',
        'cost',
        'price',
        'vat',
        'sold_qty',
        'opening_stock',
        'current_stock',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_cat_id');
    }                         
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id')->select('id', 'title', 'unit_type');
    }
}
