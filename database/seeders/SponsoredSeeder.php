<?php

namespace Database\Seeders;

use App\Models\Sponsored;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsoredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsoreds = [
            [
                'cost' => 2, 99, //euro
                'duration' => "24", //ore
                'name' => "Basic"
            ],
            [
                'cost' => 5, 99, //euro
                'duration' => "72", //ore
                'name' => "Standard"
            ],
            [
                'cost' => 9, 99, //euro
                'duration' => "144", //ore
                'name' => "Pro"
            ]
        ];

        foreach ($sponsoreds as $sponsored) {
            $new_sponsored = new Sponsored();

            $new_sponsored->cost = $sponsored['cost'];
            $new_sponsored->duration = $sponsored['duration'];
            $new_sponsored->name = $sponsored['name'];

            $new_sponsored->save();
        }
    }
}
