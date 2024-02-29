<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'post',
        'wcl',
        'duration_oil',
        'key_no',
        'employment_exchange',
        'employment_exchange_no',
        'name',
        'email',
        'mobile',
        'alternate_mobile',
        'gender',
        'nationality',
        'disability',
        'percentage_Of_disability',
        'type_Of_disability',
        'disability_certificate',
        'disability_date',
        'caste',
        'caste_certificate',
        'caste_date',
        'non_creamy',
        'non_creamy_certificate',
        'non_creamy_date',
        'ex_servicemen',
        'ex_servicemen_certificate',
        'ex_servicemen_date',
        'ex_servicemen_period',
        'date_of_birth',
        'candidate_age',
    ];
    
}
