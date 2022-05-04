<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunde extends Model
{
    use HasFactory;

    // Sætter påkrævede properties
    protected $fillable = [
        'fornavn',
        'efternavn',
        'username',
        'password',
        'email'
    ];

    // Skjuler properties i JSON
    protected $hidden = [
        'username',
        'password',
        'pivot'
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function addresser()
    {
        return $this->belongsToMany(Addresse::class,'kundes_addresses');
    }

    public function sager()
    {
        return $this->hasMany(Sag::class);
    }
}
