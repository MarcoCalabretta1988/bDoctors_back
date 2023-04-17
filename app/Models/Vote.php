<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['lable', 'color'];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)->withTimestamps();
    }
}
