<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        //Basic Information
        'name',
        'email',
        'contact',
        'country_id',
        'state',
        'city',
        'zip',

        //Positional Information
        'division_id',
        'designation_id',
        'duty_type',
        'hire_date',
        'original_hire_date',
        'termination_date',
        'termination_reason',
        'termination_voluntary',
        'rehire_date',
        'rate_type',
        'rate',
        'bonus',
        'pay_frequency',
        'pay_frequency_desc',
        'allocate_leave',
        'remaining_leave',

        //Bigraphical Information
        'date_of_birth',
        'gender',
        'marital_status',
        'ethnic_group',
        'eeo_class',
        'ssn',
        'work_in_state',
        'live_in_state',
        'image',

        //Additional Address
        'home_email',
        'home_phone',
        'cell_phone',
        'business_email',
        'business_phone',

        //Emergencry Contact
        'emerg_cont',
        'emerg_cont_alt',
        'emerg_home_cont',
        'emerg_cont_home_alt',
        'emerg_work_cont',
        'emerg_cont_work_alt',
        'emerg_cont_relations',
    
        'status',
        ];
    
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class,'division_id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class,'designation_id');
    }


}
