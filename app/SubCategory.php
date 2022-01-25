<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    
    use SoftDeletes;
    
    protected $table = 'sub_category';

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id', 'id', 'name');
    }
}
