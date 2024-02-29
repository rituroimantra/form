<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function disabilityTypes()
    {
        return $this->hasMany(DisabilityType::class);
    }
    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }
}
