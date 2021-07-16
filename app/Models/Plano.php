<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;


    public static function getPlanoNome($id){
        return Plano::find($id)->nome;
    }
}
