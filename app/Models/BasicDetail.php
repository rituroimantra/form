<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'father',
        'mother',
        'marital_status',
        'permanent_pin_code',
        'permanent_city',
        'permanent_state',
        'permanent_address_one',
        'permanent_address_two',
        'correspondence_pin_code',
        'correspondence_city',
        'correspondence_state',
        'correspondence_address_one',
        'correspondence_address_two',
    ];
}
