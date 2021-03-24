<?php

namespace App\Models;

use App\Models\BaseModel;

class Photo extends BaseModel
{
    protected $table = 'photos';

    protected $fillable = [
        'gallery', // id not hashid
        'path',
        'name',
        'author'
    ];
}
