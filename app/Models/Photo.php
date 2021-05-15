<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class Photo extends BaseModel
{
    protected $table = 'photos';

    protected $fillable = [
        'event', // hashid
        'photo',
        'title',
        'author',
        'notes',
        'note',
        'nominations',
        'comments',
        'final_notes',
        'place'
    ];

    // public $criteres = [
    //     ["Réponse au thème", "Choix du sujet, respect du thème, originalité..."],
    //     ["Composition", "Cadrage, harmonie, lumière..."],
    //     ["Technique", "Exposition, profondeur de champs, traitement..."],
    //     ["Critère subjectif", "Coup de coeur, histoire que ça raconte, émotion..."],
    // ];

    public $criteres = [ // [nom, desc, Texte de nomination si critère à nominer]
        ["Respect du thème", "Attention à bien chercher à comprendre la photo avant de dire qu'il y a hors-sujet"],
        ["Originalité", "C'est la seule comme ça? C'est recherché? Vous-y attendiez-vous?", ["La plus originale", "original", "originale"] ],
        ["Créativité", "À bien différencier de l'originalité. Y-a-t-il de l'effort, un travail de mise en scène?", ["La plus créative", "creative", "créative"] ],
        ["Composition", "Cadrage, harmonie, lumière..."],
        ["Technique", "Exposition, profondeur de champs, traitement..."],
        ["Critère subjectif", "Coup de coeur, histoire que ça raconte, émotion...", ["Coup de coeur", "crush", "coup de coeur"] ],
    ];

    public $critereOptions = [
        '0 - Vraiment pas',
        '1 - Pas trop',
        '2 - Limite',
        '3 - Respecté',
        '4 - Très bien',
        '5 - Exceptionnel',
        'Choisir la note'
    ];

    public function getEvent()
    {
        return Event::whereId(decodeId($this->event))->firstOrFail();
    }

    public function scopeEvent($query, $event_hashid) {
        return $query->where('event', $event_hashid);
    }

    public function scopeNoted($query) {
        return $query->where('notes', 'LIKE', '%'.Auth::user()->hashid.'%');
    }

    public function scopeHasPlace($query) {
        return $query->whereNotNull('place');
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

    public function scopeHasNomination($query) {
        return $query->where('nominations', '!=', '[]');
    }

    public function notesOf($jury_hashid) {
        $jurys_notes = json_decode($this->notes, true);
        return $jurys_notes[$jury_hashid];
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
