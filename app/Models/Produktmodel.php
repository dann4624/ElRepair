<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produktmodel extends Model
{
    use HasFactory;

    // Sætter tabel navn for Eloquent ORM, når ikke standard tabel navne bliver brugt
    protected $table = "produkt_models";

    // Sætter påkrævede properties
    protected $fillable = [
        'name',
        'model_id',
        'fabrikant_id',
    ];

    // Skjuler properties i JSON
    protected $hidden = [
        'type_id',
        'fabrikant_id',
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function produkter()
    {
        return $this->hasMany(Produkt::class);
    }

    public function fabrikant()
    {
        return $this->belongsTo(Fabrikant::class);
    }

    public function type()
    {
        return $this->belongsTo(Produkttype::class);
    }
}
