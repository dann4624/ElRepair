<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class By extends Model
{
    use HasFactory;
    protected $primaryKey = "postnummer";

    protected $fillable = [
        'postnummer',
        'navn'
    ];

    public function addresser()
    {
        return $this->belongsToMany(Addresse::class);
    }
}
