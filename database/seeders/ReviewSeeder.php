<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctor = Doctor::all();
        $reviews = [
            [
                'text' => "Dottore attento è preciso consigliatissimo",
                'name' => "Francesco"
            ],
            [
                'text' => "Professionista indiscusso molto paziente e disponibile",
                'name' => "Vivaldi"
            ],
            [
                'text' => "Dottore professionale preparato e attento al paziente ",
                'name' => "Napoleone"
            ],
            [
                'text' => "Dottore attento è preciso consigliatissimo",
                'name' => "Carlo Magno"
            ],
            [
                'text' => "Mi sono recato presso lo studio del dottore ed ho avuto subito un ottima impressione dottore molto preparato e scupoloso",
                'name' => "Mozart"
            ],
            [
                'text' => "Visita molto sodisfacente professionale, chiara e con modi che non tutti hanno. Complimenti dottore",
                'name' => "Bach"
            ],
            [
                'text' => "Mi sono recato presso lo studio del dottore ed ho avuto subito un ottima impressione dottore molto preparato e scupoloso",
                'name' => "Beetowen"
            ],
        ];

        foreach ($reviews as $review) {
            $new_review = new Review();

            $new_review->text = $review['text'];
            $new_review->name = $review['name'];
            $new_review->doctor_id = $doctor->random()->id;

            $new_review->save();
        }
    }
}
