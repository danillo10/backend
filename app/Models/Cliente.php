<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nome',
        'email',
        'telefone',
        'estado',
        'cidade',
        'data_nascimento',
        'plano_id'
    ];

}
