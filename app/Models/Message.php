<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    //correlation whith doctors 

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}