<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabrikant extends Model
{
    use HasFactory;

    // Sætter påkrævede properties
    protected $fillable = [
        'name',
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function modeller()
    {
        return $this->belongsToMany(Produktmodel::class);
    }
}
