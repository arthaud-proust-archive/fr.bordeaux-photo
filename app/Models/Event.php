<?php

namespace App\Models;

use App\Models\BaseModel;

class Event extends BaseModel
{
    protected $table="events";

    protected $fillable = [
        'title',
        'type',
        'date_start',
        'date_end',
        'description',
        'participants'
    ];
}
