<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {

        $doctors = [
            [
                'address' => "via Michele coppino 12",
                'city' => "Torino",
                'phone' => "3490391382",
                'curriculum' => "",
                'photo' => ""
            ],
            [
                'address' => "via Dolomiti 11",
                'city' => "Milano",
                'phone' => "3490391345",
                'curriculum' => "",
                'photo' => ""
            ],
            [
                'address' => "via Roma 143",
                'city' => "Napoli",
                'phone' => "3490391382",
                'curriculum' => "",
                'photo' => ""
            ],
            [
                'address' => "via Pippo 15, Roma",
                'city' => "Roma",
                'phone' => "3490391382",
                'curriculum' => "",
                'photo' => ""
            ],
            [
                'address' => "via Marco Polo, Catanzaro",
                'city' => "Catanzaro",
                'phone' => "3490391382",
                'curriculum' => "",
                'photo' => ""
            ],
        ];

        foreach ($doctors as $doctor) {
            $new_doctor = new Doctor();
            $new_doctor->address = $doctor['address'];
            $new_doctor->phone = $doctor['phone'];
            $new_doctor->curriculum = $doctor['curriculum'];
            $new_doctor->photo = $doctor['photo'];
            $new_doctor->city = $doctor['city'];
            $new_doctor->is_sponsored = $faker->boolean();
            $new_doctor->save();
        }
    }
}
