<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() 
    {
        $this->call([
            GameSeeder::class,
            UserSeeder::class,
            AItoolSeeder::class,
            GameAitoolSeeder::class,
            GameUserSeeder::class,
            AitoolUserSeeder::class,
            ChartHistorySeeder::class,
        ]);
    }
}
