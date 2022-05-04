<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apitoken extends Model
{
    use HasFactory;

    // Sætter påkrævede properties
    protected $fillable = [
      'token',
      'target_id',
    ];

    // Skjuler properties i JSON
    protected $hidden = [
        'target_id',
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function target()
    {
        return $this->belongsTo(Tokentarget::class);
    }
}
