<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    protected $table = 'dx_anuncio';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'titulo',
        'description'
    ];
}
