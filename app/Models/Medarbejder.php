<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Medarbejder extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Sætter påkrævede properties
    protected $fillable = [
        'fornavn',
        'efternavn',
        'username',
        'password',
    ];

    // Skjuler properties i JSON
    protected $hidden = [
        'username',
        'password',
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function sager()
    {
        return $this->hasMany(Sag::class);
    }
}
