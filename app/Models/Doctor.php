<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Doctor extends Model
{
    use HasFactory;
    //protected

    protected $with = ['user'];

    //fillable
    protected $fillable = ['address', 'photo', 'phone', 'curriculum', 'is_sponsored', 'city'];
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
        return $this->belongsToMany(Vote::class)->withPivot('end_at', 'start_at')
            ->withTimestamps();
    }
    //corelations many to many sponsoreds
    public function sponsoreds()
    {
        return $this->belongsToMany(Sponsored::class)->withTimestamps();
    }
    //corelations many to many specializations
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)->withTimestamps();
    }

    public function expired_sponsored()
    {
        $now = Carbon::now(); // recupera l'ora corrente
        $doctors = Doctor::where('is_sponsored', true)->get(); // recupera tutti i medici sponsorizzati

        foreach ($doctors as $doctor) {
            $pivot = $doctor->sponsoreds()->where('doctor_id', $doctor->id)->first()->pivot->end_at; // cerca la correlazione della sponsorizzazione scaduta
            $end = Carbon::tomorrow();
            dd($pivot);
            if ($now->gt($end)) {
                $doctor->sponsoreds()->detach($doctor->id); // rimuove la correlazione
                $doctor->is_sponsored = false; // imposta is_sponsored a false
                $doctor->save();
            }
        }
    }
}
