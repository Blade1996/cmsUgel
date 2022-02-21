<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{

    public $timestamps = false;


    protected $table = 'dx_encargatura';
    protected $fillable = ['name', 'url_image', 'confirm_answer'];
}
