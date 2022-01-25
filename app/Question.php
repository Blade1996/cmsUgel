<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use softDeletes;

    protected $table = 'questions';
    protected $fillable = ['title', 'is_activated', 'content', 'unit_id'];

    public static function booted()
    {
        static::addGlobalScope(new ActivatedScope);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function type_answers()
    {
        return $this->belongsToMany(TypeAnswer::class, 'type_answers_questions')->withPivot(['id','title', 'message', 'status', 'type_answer_valid', 'type_answer_id', 'question_id']);
    }
}
