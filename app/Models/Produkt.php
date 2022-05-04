<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
    use HasFactory;

    // Sætter påkrævede properties
    protected $fillable = [
        'name',
        'model_id'
    ];

    // Skjuler properties i JSON
    protected $hidden = [
        'model_id',
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function model()
    {
        return $this->belongsTo(Produktmodel::class);
    }

    public function fabrikant()
    {
        return $this->belongsTo(Fabrikant::class);
    }

    public function type()
    {
        return $this->belongsTo(Produkttype::class);
    }

    public function sager()
    {
        return $this->belongsToMany(Sag::class);
    }
}
