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
                $start_at = '04/04/23'; //hardcoded
                $end_at = '05/04/23'; //hardcoded
                $currentDoctor->sponsoreds()->attach($sponsored, ['start_at' => $start_at, 'end_at' => $end_at]);
            }
        }
    }
}
