<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterestLink extends Model
{

    use SoftDeletes;

    protected $table = 'interest_links';

    protected $fillable = ['url_icon', 'url_redirect', 'title'];
}
