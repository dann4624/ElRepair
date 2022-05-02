<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produktmodel extends Model
{
    use HasFactory;
    protected $table = "produkt_models";
    protected $fillable = [
        'name',
        'model_id',
        'fabrikant_id',
    ];

    protected $hidden = [
        'type_id',
        'fabrikant_id',
    ];

    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

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
