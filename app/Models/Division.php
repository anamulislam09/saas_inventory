<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'title',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
