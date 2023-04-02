<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $votes = Vote::all();

        foreach ($doctors as $doctor) {
            $voteNum = rand(0, 5);
            $randomVote = $votes->random($voteNum);

            foreach ($randomVote as $vote) {
                $doctor->votes()->attach($vote);
            }
        }
    }
}
