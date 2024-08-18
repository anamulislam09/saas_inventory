<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRSetting extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'office_start_at',
        'office_end_at',
        'daily_work_hour',
        'overtime_rate',
        'equivalent_absences',
    ];
    
}
