<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'employee_id',
        'approved_by_id',
        'created_by_id',
        'updated_by_id',
        'loan_details',
        'application_date',
        'approved_date',
        'repayment_from',
        'amount',
        'interest_percent',
        'installment_period',
        'repayment_total',
        'installment',
        'paid_amount',
        'payment_status',
        'approve_status',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id')->select('id','name');
    }
}
