<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;

class Normativity extends Model
{
    protected $table = 'dx_disposicion';
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion', 'periodo', 'estado', 'archivo'];
}
