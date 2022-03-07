<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    public $timestamps = false;

    protected $table = 'dx_contrato';
    protected $fillable = ['name', 'url_image', 'confirm_answer'];

    public function scopeCategory($query, $id)
    {
        if ($id)
            return $query->where('idcontrato_categoria', $id);
    }

    public function scopeTitle($query, $search)
    {
        if ($search)
            return $query->where('nombre', 'LIKE', "%$search%");
    }
}
