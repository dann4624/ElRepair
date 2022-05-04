<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokentarget extends Model
{
    use HasFactory;

    // Sætter tabel navn for Eloquent ORM, når ikke standard tabel navne bliver brugt
    protected $table = "apitoken_targets";

    // Sætter påkrævede properties
    protected $fillable = [
      'navn'
    ];

    // Caster properties til andre typer / formater
    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function tokens()
    {
        return $this->hasMany(Apitoken::class);
    }
}
