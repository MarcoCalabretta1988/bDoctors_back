<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    //correlation whith doctors 
    protected $fillable = ['email', 'text', 'name'];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
