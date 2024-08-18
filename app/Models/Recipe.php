<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'item_id',
        'total_cost',
        'note',
        'recipe_status',
        'created_by_id',
        'updated_by_id'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function details()
    {
        return $this->hasMany(RecipeDetails::class, 'recipe_id')->with(['raw_materials','sub_unit','main_unit']);
    }
}
