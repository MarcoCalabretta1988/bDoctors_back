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
        $users = [
            [

                'name' => 'Daniele Tuttolani',
                'email' => 'daniele@email.it',
            ],
            [
                'name' => 'Marco Calabretta',
                'email' => 'marco@email.it',
            ],
            [

                'name' => 'Pino Macrì',
                'email' => 'pino@email.it',
            ],
            [

                'name' => 'Andrea Garofalo',
                'email' => 'andrea@email.it',
            ],
            [

                'name' => 'Sebastian Ivaniczki',
                'email' => 'sebastian@email.it',
            ],

        ];
        $doctor = Doctor::all();
        foreach ($users as $lap => $i) {
            $user = new User();

            $user->name = $i['name'];
            $user->email = $i['email'];
            $user->password = bcrypt('password');
            $user->doctor_id = $doctor[$lap]->id;
            $user->save();
        }
    }
}