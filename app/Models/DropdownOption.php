<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropdownOption extends Model
{
    use HasFactory;
    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}
