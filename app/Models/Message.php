<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    //correlation whith doctors 
    protected $fillable = ['email', 'text', 'name'];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
