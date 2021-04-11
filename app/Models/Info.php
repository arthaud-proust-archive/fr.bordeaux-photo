<?php

namespace App\Models;

use App\Models\BaseModel;

class Info extends BaseModel
{
    protected $table = "infos";

    protected $fillable = [
        'title',
        'content',
        'pages'
    ];


    public function scopePage($query, $page_hashid) {
        return $query->where('pages', 'LIKE', '%'.$page_hashid.'%');
    }

    public function inPage($page_hashid) {
        return str_contains($this->pages, $page_hashid);
    }
}