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
            [
                'label' => 'Nessun voto',
                'value' => '1',
                'color' => '#ec0808',
            ],
            [
                'label' => 'Discreto',
                'value' => '2',
                'color' => '#e5ec08',
            ],
            [
                'label' => 'Buono',
                'value' => '3',
                'color' => '#197e10',
            ],
            [
                'label' => 'Ottimo',
                'value' => '4',
                'color' => '#10157e',
            ],
            [
                'label' => 'Eccellente',
                'value' => '5',
                'color' => '#821047',
            ],

        ];
        foreach ($labels as $label) {
            $new_vote = new Vote();

            $new_vote->label = $label['label'];
            $new_vote->color = $label['color'];
            $new_vote->value = $label['value'];

            $new_vote->save();
        }
    }
}
