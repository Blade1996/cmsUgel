<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auxiliar extends Model
{
    public $timestamps = false;

    protected $table = 'dx_auxi';
    protected $fillable = ['name', 'url_image', 'confirm_answer'];
}
