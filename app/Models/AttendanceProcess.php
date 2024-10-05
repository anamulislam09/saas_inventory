<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceProcess extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'date',
        'year',
        'month',
        'total_working_days',
        'total_working_hours',
        'created_by_id',
        'updated_by_id',
    ];
    public function created_by(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
}
