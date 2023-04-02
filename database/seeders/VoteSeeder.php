<?php

namespace Database\Seeders;

use App\Models\Vote;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = [
            'Discredo', 'Buono', 'Ottimo', 'Pessimo', 'Eccellente'
            /**smiters */
        ];
        foreach ($labels as $lable) {
            $new_vote = new Vote();

            $new_vote->lable = $lable;
            $new_vote->color = $faker->hexColor();

            $new_vote->save();
        }
    }
}
