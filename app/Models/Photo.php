<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Auth;

class Photo extends BaseModel
{
    protected $table = 'photos';

    protected $fillable = [
        'event', // hashid
        'photo',
        'title',
        'author',
        'notes',
        'note'
    ];

    public function scopeNoted($query) {
        return $query->where('notes', 'LIKE', '%'.Auth::user()->hashid.'%');
    }

    public function scopeNotedBy($query, $jury_hashid) {
        return $query->where('notes', 'LIKE', '%'.$jury_hashid.'%');
    }

    public function scopeNotNoted($query) {
        return $query->where('notes', 'NOT LIKE', '%'.Auth::user()->hashid.'%');
    }

    public function scopeNotNotedBy($query, $jury_hashid) {
        return $query->where('notes', 'NOT LIKE', '%'.$jury_hashid.'%');
    }

    public function scopeHasNote($query) {
        return $query->whereNotNull('note');
    }

    public function noteOf($jury_hashid) {
        $jurys_notes = json_decode($this->notes, true);
        $jury_notes = $jurys_notes[$jury_hashid];

        $note = 0;
        foreach($jury_notes as $jury_note) {
            $note+= $jury_note;
        }
        return $note;
    }

    public function getAuthorModelAttribute() {
        return user::whereId(decodeId($this->author))->firstOrFail();
    }
}
