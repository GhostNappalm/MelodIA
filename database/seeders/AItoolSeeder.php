<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aitool;

class AitoolSeeder extends Seeder
{
    public function run(): void
    {
        $numInstances = 5;
        for ($i = 1; $i <= $numInstances; $i++) {
            Aitool::create([
                'name' => 'Nome Tool ' . $i,
                'autors' => 'Autore 1, Autore 2',
                'description' => 'Descrizione del Tool ' . $i,
                'inputs' => '{"parametro 1": "valore 1" , "parametro 2": "valore 2"}',
            ]);
        }
    }
}