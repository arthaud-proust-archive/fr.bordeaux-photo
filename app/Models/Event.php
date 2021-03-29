<?php

namespace App\Models;

use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;

class Event extends BaseModel
{
    protected $table="events";

    protected $fillable = [
        'title',
        'type',
        'date_start',
        'date_end',
        'description',
        'participants',
        'jury'
    ];


    public function scopeOpen($query)
    {
        return $query
            ->where('date_start', '<', Carbon::now()->timestamp)
            ->where('date_end', '>', Carbon::now()->timestamp);
    }

    public function getUserPhotoSentAttribute() {
        return photo::where('event', $this->hashid)->where('author', Auth::user()->hashid)->first();
    }

    public function juryComplete($jury_hashid) {
        return photo::notedBy($jury_hashid)->count() == photo::where('event', $this->hashid)->count();
    }

    public function listJuryComplete() {
        return array_filter(json_decode($this->jury), function($jury_hashid) { return photo::notedBy($jury_hashid)->count() == photo::where('event', $this->hashid)->count(); });
    }
}
