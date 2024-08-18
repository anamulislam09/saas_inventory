<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'loan_id',
        'amount',
        'year_month',
        'payment_date',
        'payment_status',
    ];
}
