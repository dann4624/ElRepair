<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunde extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornavn',
        'efternavn',
        'username',
        'password',
        'email'
    ];

    protected $hidden = [
        'username',
        'password',
        'pivot'
    ];

    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    public function addresser()
    {
        return $this->belongsToMany(Addresse::class,'kundes_addresses');
    }

    public function sager()
    {
        return $this->hasMany(Sag::class);
    }
}
