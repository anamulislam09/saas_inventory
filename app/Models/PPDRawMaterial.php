<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDRawMaterial extends Model
{
    use HasFactory;
    protected $table = "ppd_raw_materials";
    protected $fillable = 
    [
        'pp_id',
        'raw_material_id',
        'quantity',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'raw_material_id')->select(['id','title','unit_id']);
    }
}
