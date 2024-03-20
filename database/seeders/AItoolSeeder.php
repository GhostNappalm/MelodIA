<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aitool;

class AitoolSeeder extends Seeder
{
    public function run(): void
    {
        // Creazione di 5 istanze di Aitool con dati unici
        $numInstances = 5;
        for ($i = 1; $i <= 2; $i++) {
            Aitool::create([
                'name' => 'ITG Generator ' . $i,
                'authors' => 'Author ' . rand(1, 5) . ', Author ' . rand(6, 10),
                'description' => 'Tool description ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et leo lectus. Integer eu luctus orci, vel condimentum odio. Sed luctus auctor turpis, a suscipit massa volutpat vel. Sed sed lorem at eros varius placerat nec at mauris. Duis facilisis leo vel sapien feugiat, in aliquet ipsum consequat. Cras maximus libero nisi, nec consequat nisi mattis at. Integer ut ligula sit amet risus luctus venenatis. Maecenas vel lacus eget purus ultrices sollicitudin nec vitae metus.',
                'inputs' => [
                    [
                        'name' => 'audio_file',
                        'type' => 'file',
                        'label' => 'Audio File',
                        'accept' => '.mp3,.wav', // Estensioni di file accettate
                        'required' => true,
                    ],
                    [
                        'name' => 'BPM',
                        'type' => 'number',
                        'label' => 'BPM',
                        'min' => 0,
                        'max' => 200,
                    ],
                    [
                        'name' => 'difficulty',
                        'type' => 'select',
                        'label' => 'Difficulty',
                        'options' => ['Easy', 'Medium', 'Hard'],
                    ],
                ],
                'method' => 'XML-RPC',
                'endpoint' => 'http://endpoint:port',
                'out_file_ext' => 'dwi'
            ]);
        }

        for ($i = 3; $i <= $numInstances; $i++) {
            Aitool::create([
                'name' => 'Osu Generator ' . $i,
                'authors' => 'Author ' . rand(1, 5) . ', Author ' . rand(6, 10),
                'description' => 'Tool description ' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et leo lectus. Integer eu luctus orci, vel condimentum odio. Sed luctus auctor turpis, a suscipit massa volutpat vel. Sed sed lorem at eros varius placerat nec at mauris. Duis facilisis leo vel sapien feugiat, in aliquet ipsum consequat. Cras maximus libero nisi, nec consequat nisi mattis at. Integer ut ligula sit amet risus luctus venenatis. Maecenas vel lacus eget purus ultrices sollicitudin nec vitae metus.',
                'inputs' => [
                    [
                        'name' => 'audio_file',
                        'type' => 'file',
                        'label' => 'Audio File',
                        'accept' => '.mp3,.wav', // Estensioni di file accettate
                        'required' => true,
                    ],
                    [
                        'name' => 'BPM',
                        'type' => 'number',
                        'label' => 'BPM',
                        'min' => 0,
                        'max' => 200,
                    ],
                    [
                        'name' => 'difficulty',
                        'type' => 'select',
                        'label' => 'Difficulty',
                        'options' => ['Easy', 'Medium', 'Hard'],
                    ],
                    [
                        'name' => 'checkbox',
                        'type' => 'checkbox',
                        'label' => 'Optimizer',
                        'value'=> '1',
                    ],
                ],
                'method' => 'XML-RPC',
                'endpoint' => 'http://endpoint:port',
                'out_file_ext' => 'osu'
            ]);
        }

        Aitool::create([
            'name' => 'DanceDanceConvolution ',
            'authors' => 'Chris Donahue, Zachary C.Lipton, Julian McAuley',
            'description' => 'Dance Dance Convolution is an automatic choreography system for Dance Dance Revolution (DDR), converting raw audio into playable dances using two neural networks to create step charts. One network predicts timing of the steps from the audio and another network creates sequences of arrows from the timings. You can read more details on https://arxiv.org/abs/1703.06891',
            'inputs' => [
                [
                    'name' => 'audio_file',
                    'type' => 'file',
                    'label' => 'Audio File',
                    'accept' => '.mp3,.wav', // Estensioni di file accettate
                    'required' => true,
                ],
                [
                    'name' => 'artist',
                    'type' => 'text',
                    'label' => 'Artist',
                    'maxlength' => 20,
                ],
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => 'Song Title',
                    'maxlength' => 20,
                ],
               
            ],
            'method' => 'XML-RPC',
            'endpoint' => 'http://192.168.56.101:1337',
            'out_file_ext' => 'sm'

        ]);
    }
}

