<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sagstype extends Model
{
    use HasFactory;
    protected $table = "sag_types";
    protected $fillable = [
        'name',
        'pris'
    ];

    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    public function sager()
    {
        return $this->hasMany(Sag::class);
    }
}
