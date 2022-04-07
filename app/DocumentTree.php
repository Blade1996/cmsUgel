<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentTree extends Model
{
    protected $table = 'document_tree';
    public $fillable = ['name', 'parent_id', 'url_file'];

    public function childs()
    {
        return $this->hasMany('App\DocumentTree', 'parent_id', 'id')->select(['id', 'name', 'url_file']);
    }
}
