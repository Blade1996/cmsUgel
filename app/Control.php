<?php


namespace App;


use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{

    protected $table = 'dx_control';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'slug',
        'route',
        'admin_id',
        'content',
        'section_id',
        'content',
        'page_image',
        'published_at'
    ];

    /**
     * The "booting" method of the model.
     */
}
