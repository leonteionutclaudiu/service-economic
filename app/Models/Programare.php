<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programare extends Model
{
    use HasFactory;
    protected $fillable = [
        'nume',
        'email',
        'nr',
        'nr_inmatriculare',
        'mesaj',
        'acceptata',
        'data_programare',
    ];

}
