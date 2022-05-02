<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apitoken extends Model
{
    use HasFactory;
    protected $fillable = [
      'token'
    ];

    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at'  => 'date:d-m-Y H:i:s',
    ];

    protected $hidden = [
        'target_id',
    ];

    public function target()
    {
        return $this->belongsTo(Tokentarget::class);
    }
}
