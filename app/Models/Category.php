<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'parent_cat_id',
        'cat_type_id',
        'title',
        'image',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_cat_id')->select('id', 'title');
    }
    public function category_type()
    {
        return $this->belongsTo(CategoryType::class, 'cat_type_id')->select('id', 'title');
    }
}
