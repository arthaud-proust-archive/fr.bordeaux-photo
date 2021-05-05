<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Event;
use Validator;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VoteController extends Controller
{

    public function show(Request $request, $event, $photo_hashid=null) {
        if($photo_hashid) {
            return view('event.vote', [
                'event' => event::whereId(decodeId($event))->firstOrFail(),
                'photo' => photo::where('event', $event)->whereId(decodeId($photo_hashid))->firstOrFail()
            ]);
            $photos = photo::where('event', $event)->notNoted()->inRandomOrder()->paginate(1);
        } else {
            $photos = photo::where('event', $event)->notNoted()->inRandomOrder()->paginate(1);
            if($photos->count() > 0) {
                return view('event.vote', [
                    'event' => event::whereId(decodeId($event))->firstOrFail(),
                    'photos' => $photos
                ]);
            }
            return redirect()->route('event.photos', $event);

        }
        
        

    }


    public function note(Request $request, $photo_hashid) {

        $validator = Validator::make($request->all(), [
            'critere1' => 'required|numeric|min:0|max:5',
            'critere2' => 'required|numeric|min:0|max:5',
            'critere3' => 'required|numeric|min:0|max:5',
            'critere4' => 'required|numeric|min:0|max:5',
            'bonus' => 'nullable|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $photo = photo::where('id', decodeId($photo_hashid))->firstOrFail();
        $event = event::where('id', decodeId($photo->event))->firstOrFail();

        // somme des critères
        // $note_perso = 0;
        // for($i=1; 5>$i;$i++) {
        //     $note_perso += intval(request('critere'.$i));
        // }

        // $note_perso += intval(request('bonus', 0));
        
        // $notes[Auth::user()->hashid] = array_values(array_filter($request->input(), function($k) {
        //     return str_starts_with($k, 'critere');
        // }, ARRAY_FILTER_USE_KEY));

        // critères
        $criteres = [];
        foreach (array_filter($request->input(), function($k) { return str_starts_with($k, 'critere');}, ARRAY_FILTER_USE_KEY) as $critere_note) {
            array_push($criteres, intval($critere_note));
        }
        array_push($criteres, intval(request('bonus', 0)));

        $notes = json_decode($photo->notes, true);
        //mise à jour de la note pour le jury actuel
        $notes[Auth::user()->hashid] =$criteres;

        $photo->notes = json_encode($notes);
        $photo->save();

        // on calcule les notes
        $this->calcNotes($photo->event);

        return redirect()->route('vote.show', $photo->event)->with('status', 'success')->with('content', 'Note ajoutée');
    }

    // calcul des notes
    public function calcNotes($event_hashid) {
        $event = event::where('id', decodeId($event_hashid))->firstOrFail();
        $photos = photo::where('event', $event_hashid)->get();
        // liste des jurés qui ont noté toutes les photos
        $jures = $event->listJuryComplete();

        // si la liste des juré qui ont voté correspond au jury
        $event->voted = $jures == json_decode($event->jury);
        $event->save();

        // si elle n'est pas vide
        if(count($jures) > 0) {
            // on va calculer la note de chaque photo
            foreach($photos as $photo) {
                
                $note_sum = false;
                // la somme des notes de chaque juré pour la photo
                foreach($jures as $jure) {
                    $note_sum += $photo->noteOf($jure);
                }

                // on divise par le nombre de jurés, pour faire la moyenne
                $note = $note_sum/count($jures);
                // on enregistre la note
                $photo->note = $note;
                $photo->save();
            }
        } else {
            foreach($photos as $photo) {
                $photo->note = NULL;
                $photo->save();
            }
        }



        return 'ok';
        // return redirect()->route('event.results', $event_hashid)->with('status', 'success')->with('content', 'Notes calculées');
    }
}
