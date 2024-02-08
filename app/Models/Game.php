<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    protected $table = 'games';

    protected $fillable =[
        'name',
        'description',
        'image_path',
    ];

    public function aitools()
    {
        return $this->belongsToMany(Aitool::class, 'game_aitool');
    }
    

    public function N_aitools()
    {
        return $this->belongsToMany(Aitool::class, 'game_aitool')->count();
    }
}
