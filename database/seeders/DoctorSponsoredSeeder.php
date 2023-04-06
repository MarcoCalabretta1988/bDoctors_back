<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Sponsored;
use Faker\Generator;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSponsoredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $doctors = Doctor::pluck('id')->toArray();
        $sponsoreds = Sponsored::pluck('id')->toArray();

        $maxSponsoreds = count($sponsoreds) - 1;

        foreach ($doctors as $doctor) {
            if ($faker->boolean()) {
                $currentDoctor = Doctor::find($doctor);
                $sponsored = $sponsoreds[$faker->numberBetween(0, $maxSponsoreds)];
                $sponsoredDuration = Sponsored::find($sponsored)->duration;
                $start_at = Carbon::now(); // dynamic start date
                $end_at = $start_at->copy()->addHours($sponsoredDuration); // calculate end date based on start date and sponsored duration in hours
                $durationInDays = $start_at->diffInDays($end_at); // calculate duration in days
                $start_at = $start_at->format('Y/m/d'); // format start date year/mounth/day
                $end_at = $end_at->format('Y/m/d'); // format end date with year/mounth/day
                $currentDoctor->sponsoreds()->attach($sponsored, ['start_at' => $start_at, 'end_at' => $end_at]);
            }
        }
    }
}
