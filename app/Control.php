<?php


namespace App;


use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{

    protected $table = 'dx_control';
    public $timestamps = false;
    protected $fillable = ['title', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video'];

    /**
     * The "booting" method of the model.
     */
}
