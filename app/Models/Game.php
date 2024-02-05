<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    protected $table = 'games';

    protected $fillable =[
        'name',
        'image_path',
    ];

    public function aitools()
    {
        return $this->belongsToMany(AItool::class, 'game_aitool', 'game_id', 'aitool_id');
    }
}
