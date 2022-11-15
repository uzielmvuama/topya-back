<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $attribute = [
        'finished' => false,
        'hand'=> 0
    ];
    protected $fillable = [
        'id',
        'gkey',
        'id_user',
        'hand',
        'finished'
    ];
}
