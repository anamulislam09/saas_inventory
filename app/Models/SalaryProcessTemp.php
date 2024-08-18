<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryProcessTemp extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'employee_id',
        'year',
        'month',
        'basic_salary',
        'bonus',
        'overtime',
        'others',
        'absent',
        'late',
        'loan',
        'net_payable',
        'created_by_id',
        'updated_by_id',
    ];
    
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id')->select('id','name');
    }
}
