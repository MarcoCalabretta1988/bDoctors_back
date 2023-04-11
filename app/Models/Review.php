<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['text', 'name', 'doctor_id'];
    //correlation whith doctors 

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
