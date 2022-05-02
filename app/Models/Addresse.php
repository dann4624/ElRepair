<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
    use HasFactory;

    protected $fillable = [
        'vej',
        'vej_nummer',
        'by_postnummer'
    ];

    protected $hidden = [
        'by_postnummer',
        'pivot'
    ];

    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
        'foretrukken' => 'boolean',
    ];

    public function kunder()
    {
        return $this->belongsToMany(Kunde::class,'kundes_addresses');
    }

    public function by()
    {
        return $this->belongsTo(By::class);
    }
}
