<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class By extends Model
{
    use HasFactory;

    // Sætte primary key fra databasen, når standard ID column ikke bliver brugt
    protected $primaryKey = "postnummer";

    // Sætter påkrævede properties
    protected $fillable = [
        'postnummer',
        'navn'
    ];

    /*
     * Relationer til andre Modeller / Tabeller
     */
    public function addresser()
    {
        return $this->belongsToMany(Addresse::class);
    }
}
