<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aitool;
use App\Models\User;

class AitoolUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aitool1 = Aitool::find(1);
        $aitool2 = Aitool::find(4);

        $user1 = User::find(1);
        $user2 = User::find(2);
        
        $user1->favAitools()->attach($aitool1);
        $user1->favAitools()->attach($aitool2);

        $user2->favAitools()->attach($aitool2);

        $user3 = User::find(11);
        $user3->favAitools()->attach($aitool1);
        $user3->favAitools()->attach($aitool2);
    }
}
