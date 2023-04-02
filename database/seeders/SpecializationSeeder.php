<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $specializations = ["Chirurgia", "Cardiologia", "Malattie infettive", "Allergologia", "Patologia", "Radiologia", "Geriatria", "Dermatologia", "Nefrologia"];

        foreach ($specializations as $specialization) {
            $new_specialization = new Specialization();

            $new_specialization->name = $specialization;
            $new_specialization->color = $faker->hexColor();

            $new_specialization->save();
        }
    }
}
