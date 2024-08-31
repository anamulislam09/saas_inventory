<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'client_id',
        'title',
        'moto',
        'phone1',
        'phone2',
        'email',
        'address',
        'logo',
        'favIcon',
        'currency_code',
        'currency_symbol',
        'acceptPaymentType',
        'copyRightName',
        'copyRightLink',
        'mapLink',
        'facebook',
        'instagram',
        'twitter',
        'pinterest',
        'linkedIn',
    ];
}
