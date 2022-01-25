<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'helpCenter',
        'slug',
        'beforeRegister',
        'companyInfo'
    ];

    protected $casts = [
        'helpCenter' => 'object',
        'cookiePolicy' => 'object',
        'privacyPolicy' => 'object',
        'companySeo' => 'object',
        'companyInfo' => 'object',
    ];

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
        $title = str_replace('ú', 'u', $title);

        //Quitando Caracteres Especiales
        $title = str_replace('"', '', $title);
        $title = str_replace(':', '', $title);
        $title = str_replace('.', '', $title);
        $title = str_replace(',', '', $title);
        $title = str_replace(';', '', $title);
        return $title;
    }
}
