<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'title'
    ];


    public function divisions()
    {
        return $this->hasMany(Division::class, 'department_id');
    }
}
