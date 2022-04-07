<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documents extends Model
{
    use SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'id',
        'title',
        'category_id',
        'description',
        'url_file',
        'slug',
        'route',
    ];
}
