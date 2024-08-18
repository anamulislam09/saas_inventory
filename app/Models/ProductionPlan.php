<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPlan extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'plan_no',
        'date',
        'note',
        'status',
        'created_by_id',
        'updated_by_id',
    ];

    public function ppdetails()
    {
        return $this->hasMany(PPDetails::class, 'pp_id');
    }
    public function ppdraw_materials()
    {
        return $this->hasMany(PPDRawMaterial::class, 'pp_id');
    }
}
