<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsored extends Model
{
    use HasFactory;
    protected $fillable = ['cost', 'duration', 'name'];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)->withTimestamps();
    }
}
