<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Announcements extends Model implements HasMedia
{


    use InteractsWithMedia;

    protected $table = 'dx_convocatoria';

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->latest('fecha');
        });
    }

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'idconvocatoria_categoria',
        'archivo',
        'archivo_eval',
        'archivo_final'
    ];

    public function files()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
