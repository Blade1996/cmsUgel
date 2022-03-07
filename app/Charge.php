<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{

    public $timestamps = false;


    protected $table = 'dx_encargatura';
    protected $fillable = ['name', 'url_image', 'confirm_answer'];

    public function scopeCategory($query, $id)
    {
        if ($id)
            return $query->where('idencargatura_categoria', $id);
    }

    public function scopeTitle($query, $search)
    {
        if ($search)
            return $query->where('nombre', 'LIKE', "%$search%");
    }
}
