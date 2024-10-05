<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'leave_taken_by_id',
        'handover_to_id',
        'created_by_id',
        'approved_by_id',
        'leave_type_id',
        'application_start_date',
        'application_end_date',
        'approved_start_date',
        'approved_end_date',
        'application_days',
        'approved_days',
        'image',
        'reason',
    ];

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
    public function leave_taken_by()
    {
        return $this->belongsTo(Employee::class, 'leave_taken_by_id');
    }
    public function duty_handover_to()
    {
        return $this->belongsTo(Employee::class, 'handover_to_id');
    }
}
