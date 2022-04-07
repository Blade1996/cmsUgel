<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;

class Normativity extends Model
{
    protected $table = 'dx_disposicion';
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion', 'periodo', 'estado', 'archivo'];

    public function scopeCategory($query, $id)
    {
        if ($id)
            return $query->where('iddisposicion_categoria', $id);
    }

    public function scopeTitle($query, $search)
    {
        if ($search)
            return $query->where('nombre', 'LIKE', "%$search%");
    }
}
