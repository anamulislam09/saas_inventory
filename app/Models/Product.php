<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'cat_id',
        'sub_cat_id',
        'unit_id',
        'product_name',
        'description',
        'image',
        'status',
        'created_by',
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
