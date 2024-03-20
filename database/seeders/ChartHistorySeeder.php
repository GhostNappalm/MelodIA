<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChartHistory;
use Illuminate\Support\Facades\Storage;

class ChartHistorySeeder extends Seeder
{
    public function run()
    {
        $chartHistory = new ChartHistory();
        $chartHistory->user_id = 11;
        $chartHistory->aitool_id = 1;
        $chartHistory->file_name = 'chartA.dwi';
        $chartHistory->fileb64 = 'test';
        $chartHistory->inputs = json_encode(['BPM' => '100','Difficulty' => 'Medium', 'Style' => 'Endurance' ]);
        $chartHistory->save();

        $chartHistory = new ChartHistory();
        $chartHistory->user_id = 11;
        $chartHistory->aitool_id = 2;
        $chartHistory->file_name = 'chartB.dwi';
        $chartHistory->fileb64 = 'test';
        $chartHistory->inputs = json_encode(['BPM' => '120','Difficulty' => 'Hard' ]);
        $chartHistory->save();
        
    }
}
