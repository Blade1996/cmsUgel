<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertising extends Model
{

    protected $table = 'dx_publicidad';

    public $timestamps = false;

    protected $fillable = ['titulo', 'idpublicidad_categoria', 'url', 'imagen'];
}
