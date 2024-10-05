<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceProcessDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'attendance_process_id',
        'employee_id',
        'absent_days',
        'late_to_absent_days',
        'net_absent_days',
        'present_days',
        'leave_days',
        'net_present_days',
        'regular_hours_worked',
        'overtime_hours',
        'total_hours_worked',
    ];

}
