<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DoctorSeeder::class,
            SponsoredSeeder::class,
            MessageSeeder::class,
            ReviewSeeder::class,
            VoteSeeder::class,
            UserSeeder::class,
            SpecializationSeeder::class,
            DoctorSpecializationSeeder::class,
            DoctorVoteSeeder::class,
            DoctorSponsoredSeeder::class
        ]);
    }
}
