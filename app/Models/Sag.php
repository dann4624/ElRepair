<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sag extends Model
{
    use HasFactory;

    // Sætter påkrævede properties
    protected $fillable = [
        'indlevering',
        'status_skift',
        'beskrivelse',
        'chip_id',
        'medarbejder_id',
        'kunde_id',
        'produkt_id',
        'status_id',
        'sagstype_id',
        'afhentningstype_id',
    ];

    // Skjuler properties i JSON
    protected $hidden = [
        'medarbejder_id',
        'kunde_id',
        'produkt_id',
        'status_id',
        'sagstype_id',
        'afhentningstype_id',
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'status_skift'  => 'date:d-m-Y H:i:s',
        'indlevering'  => 'date:d-m-Y H:i:s',
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function medarbejder()
    {
        return $this->belongsTo(Medarbejder::class);
    }

    public function kunde()
    {
        return $this->belongsTo(Kunde::class);
    }

    public function afhentningstype()
    {
        return $this->belongsTo(Afhentningstype::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function sagstype()
    {
        return $this->belongsTo(Sagstype::class);
    }

    public function produkt()
    {
        return $this->belongsTo(Produkt::class);
    }
}
