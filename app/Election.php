<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Election extends Model
{
    public $timestamps = false;


    protected $table = 'dx_eleccion';
    protected $fillable = ['name', 'url_image', 'confirm_answer'];
}
