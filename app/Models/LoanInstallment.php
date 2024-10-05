<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'loan_id',
        'amount',
        'year_month',
        'payment_date',
        'payment_status',
    ];
}
