<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produkt extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model_id'
    ];

    protected $hidden = [
        'model_id',
    ];

    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

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
