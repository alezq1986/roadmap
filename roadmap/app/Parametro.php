<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $fillable = ['codigo', 'valor', 'descricao'];
}
