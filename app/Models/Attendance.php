<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'employee_id',
        'created_by_id',
        'date',
        'in_at',
        'out_at',
        'worked_hour',
        'over_time_hour',
        'note',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
