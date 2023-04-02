<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = Doctor::all();
        $messages = [
            [
                'email' => "francesco@gmail.com",
                'text' => "Buongiorno vorrei prenotare una visita nel suo studio il giorno 14/10/23",
                'name' => "Francesco Barone"
            ],

            [
                'email' => "giorgio.s@gmail.com",
                'text' => "Buona sera le ricordo che deve mandarmi la ricetta per l'oki che le ho chiesto ieri",
                'name' => "Giorgio Saracino"
            ],
            [
                'email' => "carbotta.l@gmail.com",
                'text' => "Cia, le volevo chiedere se poteva rilasciarmi il codice per la mutua dal 12/7/23 al 15/7/23",
                'name' => "Carbotta Luigi"
            ],
            [
                'email' => "alessandrogaidol@gmail.com",
                'text' => "La volevo informare che le medicine da lei consigliate mi hanno aiutato molto la ringrazio",
                'name' => "Alessandro Gaido"
            ],
            [
                'email' => "michele@gmail.com",
                'text' => "Grazie per la sua disbonibilita a rievermi con cosi poco preavviso",
                'name' => "Michele Einaudi"
            ],

        ];

        foreach ($messages as $message) {
            $new_message = new Message();

            $new_message->email = $message['email'];
            $new_message->text = $message['text'];
            $new_message->name = $message['name'];
            $new_message->doctor_id = $doctor->random()->id;

            $new_message->save();
        }
    }
}
