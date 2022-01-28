<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Documents extends Model implements HasMedia
{
    use SoftDeletes;

    use InteractsWithMedia;

    protected $table = 'documents';

    protected $fillable = [
        'id',
        'title',
        'category_id',
        'description',
        'slug',
        'route',
    ];

    public function files()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
