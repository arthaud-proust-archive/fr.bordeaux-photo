<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "infos";

    protected $fillable = [
        'title',
        'content'
    ];

    public function getHashidAttribute() {
        return encodeId($this->id);
    }
}
