<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Doctor extends Model
{
    use HasFactory;
    //corelations user
    protected $fillabale = ['phone', 'address', 'curriculum', 'photo'];
    public function user()
    {
        return $this->hasOne(User::class);
    }
    //corelation mesage one to many 
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    //correlation whith review one to one 

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    //corelations many to many votes

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    //corelations many to many sponsoreds
    public function sponsoreds()
    {
        return $this->hasMany(Sponsored::class);
    }
    //corelations many to many specializations
    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }
}
