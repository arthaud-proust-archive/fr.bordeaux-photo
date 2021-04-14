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
        'jury',
        'voted'
    ];


    public function scopeOpen($query)
    {
        return $query
            ->where('date_start', '<', Carbon::now()->timestamp)
            ->where('date_end', '>', Carbon::now()->timestamp);
    }

    public function scopeRecent($query)
    {
        return $query->where('date_end', '>', Carbon::now()->subMonth()->timestamp);
    }

    public function scopeOld($query)
    {
        return $query->where('date_end', '<', Carbon::now()->subMonth()->timestamp);
    }

    public function getIsVotingAttribute() {
        return $this->getIsEndedAttribute() && !$this->voted;
    }

    public function getOpenInAttribute() {
        $diff = Carbon::createFromTimestamp($this->date_start)->diffInDays(Carbon::now());
        return $diff==0?'Ouvre demain':'Ouvre dans '.$diff.' jour'.($diff>1?'s':'');
    }

    public function getCloseInAttribute() {
        $diff = Carbon::createFromTimestamp($this->date_end)->addDay()->diffInDays(Carbon::now());
        return $diff==0?'Fin ce soir':'Fin dans '.$diff.' jour'.($diff>1?'s':'');
    }

    public function getIsOpenAttribute() {
        // dd([Carbon::now()->format('Y-m-d H:m:s'), Carbon::createFromTimestamp($this->date_start)->format('Y-m-d H:m:s')]);
        return $this->getIsStartedAttribute() && !$this->getIsEndedAttribute() ;
    }

    public function getIsStartedAttribute() {
        return $this->date_start < Carbon::now()->timestamp;
    }

    public function getIsEndedAttribute() {
        return Carbon::createFromTimestamp($this->date_end)->addDay()->timestamp < Carbon::now()->timestamp;
    }

    public function getReadableDatesAttribute() {
        return ($this->date_start == $this->date_end) ? 'le '.timestampToReadableDate($this->date_start)
        :'du '.timestampToReadableDate($this->date_start, 'OD MMMM').' au '.timestampToReadableDate($this->date_end);
    }

    public function getDatesAttribute() {
        return timestampToDate($this->date_start).'  à  '.timestampToDate($this->date_end);
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
