<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ChartHistory;
use App\Models\Game;
use App\Models\Aitool;


class UserController extends Controller
{
    public function history()
    {
        $user = Auth::user();
        $charts = $user->chartHistoryWithNames(); // Chiamata alla funzione nel modello User
        foreach ($charts as $chart) {
            $chart->inputs = json_decode($chart->inputs, true);
        }
        return view('history', ['charts' => $charts]);
    }

    public function deleteChart($id)
    {
        ChartHistory::findOrFail($id)->delete();
        return back();
    }

    
    public function downloadChart($id)
    {
        // Trova il chart dal database
        $chart = ChartHistory::findOrFail($id);
        $filename=$chart->file_name;
        $file_decoded= base64_decode($chart->fileb64);
        file_put_contents($filename, $file_decoded);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function favGame_flag(Request $request)
    {
        $user = Auth::user();
        $game_id = $request->input('game_id');
        $game = Game::find($game_id);

            if ($user->favgames()->find($game_id)) {
                $user->favGames()->detach($game);
                return response()->json(['message' => 'Game removed from favorites','state' => '1']);
            } else {
                $user->favGames()->attach($game);
                return response()->json(['message' => 'Game added to favorites','state' => '0']);
            }

    }

    public function favAitool_flag(Request $request)
    {
        $user = Auth::user();
        $aitool_id = $request->input('aitool_id');
        $aitool = Aitool::find($aitool_id);

            if ($user->favAitools()->find($aitool_id)) {
                $user->favAitools()->detach($aitool);
                return response()->json(['message' => 'Game removed from favorites','state' => '1']);
            } else {
                $user->favAitools()->attach($aitool);
                return response()->json(['message' => 'Game added to favorites','state' => '0']);
            }

    }
}
