<?php

namespace App\Models;

use App\Models\BaseModel;

class Info extends BaseModel
{
    protected $table = "infos";

    protected $fillable = [
        'title',
        'content'
    ];
}