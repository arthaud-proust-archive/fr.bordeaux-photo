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

    public $criteres = [
        "Réponse au thème" => "Choix du sujet, respect du thème, originalité...",
        "Composition" => "Cadrage, harmonie, lumière...",
        "Technique" => "Exposition, profondeur de champs, traitement...",
        "Critère subjectif" => "Coup de coeur, histoire que ça raconte, émotion..."
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
