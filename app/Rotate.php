<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rotate extends Model
{
    public $timestamps = false;


    protected $table = 'dx_rotacion';
    protected $fillable = ['name', 'url_image', 'confirm_answer'];
}
