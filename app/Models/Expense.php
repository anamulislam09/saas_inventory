<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'expense_no',
        'date',
        'total_amount',
        'expense_note',
        'status',
        'created_by_id',
        'updated_by_id',
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by_id');
    }
    public function expense_details()
    {
        return $this->hasMany(ExpenseDetails::class, 'expense_id')->with(['expense_head','expense_cat']);
    }
}
