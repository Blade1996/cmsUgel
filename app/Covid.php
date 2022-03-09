<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    public $timestamps = false;

    protected $table = 'dx_covid';
    protected $fillable = ['title', 'message', 'status', 'type_answer_valid', 'type_answer_id', 'question_id'];
}
