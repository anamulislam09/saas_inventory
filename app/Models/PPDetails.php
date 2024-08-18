<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDetails extends Model
{
    use HasFactory;
    protected $table = "pp_details";

    protected $fillable = 
    [
        'pp_id',
        'recipe_id',
        'quantity',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
