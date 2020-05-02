<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    public function entidades()
    {
        return $this->morphTo();
    }
}
