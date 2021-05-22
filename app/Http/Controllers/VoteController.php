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
        $event = event::whereId(decodeId($event))->firstOrFail();
        if($photo_hashid && $event->isVoting) {
            return view('event.vote', [
                'event' => $event,
                'photo' => photo::where('event', $event->hashid)->whereId(decodeId($photo_hashid))->firstOrFail()
            ]);
            $photos = photo::where('event', $event->hashid)->notNoted()->inRandomOrder()->paginate(1);
        } else {
            $photos = photo::where('event', $event->hashid)->notNoted()->inRandomOrder()->paginate(1);
            if($photos->count() > 0) {
                return view('event.vote', [
                    'event' => $event,
                    'photos' => $photos
                ]);
            }
            return redirect()->route('event.photos', $event->hashid);

        }
        
        

    }


    public function note(Request $request, $photo_hashid) {

        $validator = Validator::make($request->all(), [
            'critere1' => 'required|numeric|min:0|max:5',
            'critere2' => 'required|numeric|min:0|max:5',
            'critere3' => 'required|numeric|min:0|max:5',
            'critere4' => 'required|numeric|min:0|max:5',
            'bonus' => 'nullable|numeric|min:0',
            'comment' => 'nullable|string'
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

        if(request('comment')) {
            $comments = json_decode($photo->comments, true);
            $comments[Auth::user()->hashid] = request('comment');
            $photo->comments = json_encode($comments);
        }

        $photo->save();

        // on calcule les notes
        $this->calcNotes($photo->event);

        return redirect()->route('vote.show', $photo->event)->with('status', 'success')->with('content', 'Note ajoutée');
    }

    // calcul des notes
    public function calcNotes($event_hashid) {
        $event = event::where('id', decodeId($event_hashid))->firstOrFail();
        $photos = photo::event($event_hashid)->get();
        // liste des jurés qui ont noté toutes les photos
        $jures = $event->listJuryComplete();

        // si la liste des juré qui ont voté correspond au jury
        $event->voted = $jures == json_decode($event->jury);
        $event->save();

        // si elle n'est pas vide et si y'a des photos
        if( count($jures) > 0 && $photos->count()>0 ) {

            // on va calculer la note de chaque photo et ses nominations (la meilleure d'un critère?, ex la plus originale)

            // comme on va passer sur les photos, on fait en même temps la comparaison des notes
            $maxCriteres = []; // tableau des critères à nominer

            // création du tableau des critères
            // pour chaque critère
            for($i=0; count($photos[0]->criteres)>$i; $i++) {
                if(count($photos[0]->criteres[$i]) > 2) { // si le critère est à nominer
                    $maxCriteres[$i] = ['max'=>0, 'photo'=>null]; // on l'ajoute au tableau
                }
            }
            $njure = count($jures);

            // pour chaque photo
            foreach($photos as $photo) {
                
                $note = 0;// somme des critères
                $photo_notes = json_decode($photo->notes, true);
                $final_notes = [];
                // on calcule la moyenne du jury pour chacun des critères
                for($k=0; count($photos[0]->criteres)>$k; $k++) {
                    $critere_sum = 0;
                    // la somme des notes de chaque juré pour le critere
                    foreach($jures as $jure) {
                        $critere_sum += $photo_notes[$jure][$k];
                    }

                    // on divise par le nombre de jurés, pour faire la moyenne
                    $critere_note = $critere_sum/$njure;
                    // on compare avec la plus haute note pour ce critère
                    // if(array_key_exists($k, $maxCriteres) && $maxCriteres[$k]['max']< $critere_note) {
                    //     $maxCriteres[$k]['max'] = $critere_note;
                    //     $maxCriteres[$k]['photo'] = $photo->hashid;
                    // }
                    
                    $note+=$critere_note;
                    array_push($final_notes, $critere_note);
                }
                
                // on enregistre la note
                $photo->note = $note;
                $photo->final_notes = json_encode($final_notes);
                $photo->nominations = "[]";
                $photo->save();
            }


            // attribution des places en fonction des notes
            $photos = $photo::event($event_hashid)->hasNote()->orderBy('note', 'desc')->get();
            $place = 1;
            foreach($photos as $photo) {
                $photo->place = $place;
                $photo->save();

                // en dehors du podium,
                // on attribue les lauréats
                $final_notes = json_decode($photo->final_notes, true);

                $laureatN = 0;

                // on calcule la moyenne du jury pour chacun des critères
                for($k=0; count($final_notes)>$k; $k++) {
                    if($place<=3) {
                        // $final_notes[$k] -=2-($place/2);
                        $final_notes[$k] -= (2+$laureatN)*exp(-0.5*$place);
                    }
                    // on compare avec la plus haute note pour ce critère
                    if(array_key_exists($k, $maxCriteres) && $maxCriteres[$k]['max']< $final_notes[$k]) {
                        $laureatN++;
                        $maxCriteres[$k]['max'] = $final_notes[$k];
                        $maxCriteres[$k]['photo'] = $photo->hashid;
                    }
                }

                $place++;

            }

            // dd($maxCriteres);
            // attribution des nominations aux photos
            foreach($maxCriteres as $j => $maxCritere) {
                if($maxCritere['max']>0) { // si il y a une nomination
                    $photo = Photo::whereId(decodeId($maxCritere['photo']))->firstOrFail();
                    $nominations = json_decode($photo->nominations, true);
                    array_push($nominations, $j);
                    $photo->nominations = json_encode($nominations);
                    $photo->save();
                }
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
