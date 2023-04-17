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
            $currentDoctor = Doctor::find($doctor);
            if ($currentDoctor->is_sponsored) {
                $sponsored = $sponsoreds[$faker->numberBetween(0, $maxSponsoreds)];
                $currentDoctor->sponsoreds()->attach($sponsored);
            }
        }
    }
}
