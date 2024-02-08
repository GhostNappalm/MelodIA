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
        $chartHistory->aitool_name = 'AI tool 1';
        $chartHistory->file_name = 'osuchart.osz';
        $chartHistory->inputs = json_encode(['BPM' => '100','Difficulty' => 'Medium', 'Style' => 'Endurance' ]);
        $chartHistory->save();

        $chartHistory = new ChartHistory();
        $chartHistory->user_id = 11;
        $chartHistory->aitool_name = 'AI tool 3';
        $chartHistory->file_name = 'osuchart.osz';
        $chartHistory->inputs = json_encode(['BPM' => '120','Difficulty' => 'Hard' ]);
        $chartHistory->save();
        
    }
}
