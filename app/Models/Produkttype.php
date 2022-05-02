<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkttype extends Model
{
    use HasFactory;
    protected $table = "produkt_types";
    protected $fillable = [
        'name',
    ];


    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    public function modeller()
    {
        return $this->hasMany(Produkt::class);
    }
}
