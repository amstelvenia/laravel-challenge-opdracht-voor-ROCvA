<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Woningen extends Model
{
    protected $fillable = [
        'naam',
        'beschrijving',
        'oppervlakte',
        'prijs',
    ];
    protected $table = 'woningens';
    use HasFactory;
}
