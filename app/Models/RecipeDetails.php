<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'recipe_id',
        'raw_material_id',
        'sub_quantity',
        'sub_unit_price',
        'sub_unit_id',
        'main_unit_id',
        'main_quantity',
        'main_unit_price',
        'cost',
    ];
    public function raw_materials()
    {
        return $this->belongsTo(Item::class, 'raw_material_id');
    }
    public function sub_unit()
    {
        return $this->belongsTo(Unit::class, 'sub_unit_id');
    }
    public function main_unit()
    {
        return $this->belongsTo(Unit::class, 'main_unit_id');
    }
}
