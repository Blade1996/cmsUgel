<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcements extends Model
{
    protected $table = 'dx_convocatoria';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'idconvocatoria_categoria',
        'archivo',
    ];

    public function files()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
