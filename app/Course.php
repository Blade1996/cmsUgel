<?php

namespace App;

use App\Scopes\ActivatedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table = 'courses';
    protected $fillable = ['title', 'url_image', 'is_activated', 'slug' , 'banner' , 'file_url'];

    protected static function booted()
    {
        static::addGlobalScope(new ActivatedScope);
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses')->withPivot('id', 'init_date', 'final_date', 'insc_date', 'flag_registered', 'flag_completed');
    }

    public function cleanSlug($title) 
    { 
        $title = str_replace('á', 'a', $title); 
        $title = str_replace('Á', 'A', $title); 
        $title = str_replace('é', 'e', $title); 
        $title = str_replace('É', 'E', $title); 
        $title = str_replace('í', 'i', $title); 
        $title = str_replace('Í', 'I', $title); 
        $title = str_replace('ó', 'o', $title); 
        $title = str_replace('Ó', 'O', $title); 
        $title = str_replace('Ú', 'U', $title); 
        $title= str_replace('ú', 'u', $title); 

        //Quitando Caracteres Especiales 
        $title= str_replace('"', '', $title); 
        $title= str_replace(':', '', $title); 
        $title= str_replace('.', '', $title); 
        $title= str_replace(',', '', $title); 
        $title= str_replace(';', '', $title); 
        return $title; 
    }
}
