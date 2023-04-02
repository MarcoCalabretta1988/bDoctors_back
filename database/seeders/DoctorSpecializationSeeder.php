<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $specializations = Specialization::all();

        foreach ($doctors as $doctor) {
            $specializationNum = rand(1, 3);
            $randspecialization = $specializations->random($specializationNum);

            foreach ($randspecialization as $specialization) {
                $doctor->specializations()->attach($specialization);
            }
        }
    }
}
