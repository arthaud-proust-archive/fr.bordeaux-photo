<?php

namespace App\Models;

use App\Models\BaseModel;

class Gallery extends BaseModel
{
    protected $table="gallery";

    protected $fillable = [
        'name',
        'description'
    ];
}
