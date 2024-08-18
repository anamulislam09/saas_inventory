<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticate;

class Admin extends Authenticate
{
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable =
    [
        'client_id',
        'name',
        'type',
        'mobile',
        'email',
        'password',
        'image',
        'address',
        'nid_no',
        'status',
        'is_client',
        'package_id',
        'package_start_date',
        'customer_balance',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'type');
    }
}
