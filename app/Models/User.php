<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function favGames()
    {
        return $this->belongsToMany(Game::class, 'game_user');
    }

    public function favAitools()
    {
        return $this->belongsToMany(Aitool::class, 'aitool_user');
    }

    public function chartHistory()
    {
        return $this->hasMany(ChartHistory::class);
    }

    public function chartHistoryWithNames()
    {
        $charthistories = DB::table('charthistory')
        ->join('aitools', 'charthistory.aitool_id', '=', 'aitools.id')
        ->select('charthistory.*', 'aitools.name as aitool_name')
        ->where('charthistory.user_id','=', $this->id)
        ->orderBy('charthistory.created_at','desc')
        ->get();
        return $charthistories;
    }
}
