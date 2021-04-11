<?php

namespace App\Models;

use App\Models\BaseModel;

class Page extends BaseModel
{
    protected $table = "pages";

    protected $fillable = [
        'title',
        'description',
        'url'
    ];
}
