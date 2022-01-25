<?php


namespace App;


use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $table = 'units';
    protected $fillable = ['title', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video'];

    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActivatedScope);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'unit_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'unit_users_course')->withPivot('id', 'unit_id', 'questions', 'date_answered');
    }

}
