<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $doctor = Doctor::all();
        for ($i = 0; $i < 5; $i++) {
            $user = new User();

            $user->name =  $faker->name();
            $user->email = $faker->email();
            $user->password = bcrypt('password');
            $user->doctor_id = $doctor[$i]->id;
            $user->save();
        }
    }
}
