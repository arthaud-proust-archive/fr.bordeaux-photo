<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Photo;
use App\Models\User;
use Validator;
use Response;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index() {
        return view('event.index', [
            'events' => event::recent()->orderBy('date_end', 'desc')->paginate(10),
            'oldEvents' => event::old()->count() > 0
        ]);
    }

    public function indexOlds() {
        return view('event.olds', [
            'events' => event::old()->orderBy('date_end', 'desc')->paginate(10)
        ]);
    }

    public function show(Request $request, $hashid) {
        return view('event.show', [
            'event' => event::whereId(decodeId($hashid))->firstOrFail(),
        ])
        // ->with('status', 'success')->with('content', 'Vous avez déjà ajouté une photo, modifiez-la')
        ;

    }

    public function jury(Request $request, $hashid) {
        $event = event::whereId(decodeId($hashid))->firstOrFail();
        return view('event.jury', [
            'event' => event::whereId(decodeId($hashid))->firstOrFail()
        ])
        // ->with('status', 'success')->with('content', 'Vous avez déjà ajouté une photo, modifiez-la')
        ;

    }

    public function getdesc(Request $request, $hashid) {
        $event = event::whereId(decodeId($hashid))->firstOrFail();
        return response(bindPagesRoute($event->description), 200)
        ->header('Content-Type', 'text/plain');
    }

    public function results(Request $request, $hashid) {
        return view('event.results', [
            'event' => event::whereId(decodeId($hashid))->firstOrFail(),
            'podium' => photo::event($hashid)->hasNote()->orderBy('place')->take(3)->get(),
            'nomineds' => photo::event($hashid)->hasNote()->hasNomination()->get(),
            'results' => photo::event($hashid)->hasNote()->orderBy('place')->paginate(5)
        ]);
    }

    public function photos(Request $request, $hashid) {
        return view('event.photos', [
            'event' => event::whereId(decodeId($hashid))->firstOrFail(),
            'photos' => photo::event($hashid)->get()
        ]);
    }
    

    public function create() {
        return view('event.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required',
            'dates' => ['required', 'regex:/[0-3][0-9]-[0-1][0-9]-[0-9][0-9][0-9][0-9]  à  [0-3][0-9]-[0-1][0-9]-[0-9][0-9][0-9][0-9]/i'],
            // 'date_start' => 'required',
            // 'date_end' => 'required',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $dates = explode('  à  ', request('dates'));
        $date_start = dateToTimestamp($dates[0]);
        $date_end = dateToTimestamp($dates[1]);

        $event = event::create([
            'title' => request('title'),
            'type' => request('type'),
            'date_start' => $date_start,
            'date_end' => $date_end,
            'description' => request('description'),
            'jury' => json_encode(User::jury()->active()->get()->pluck('hashid')->toArray()),
            'participants' => '[]'
        ]);
        return redirect()->route('event.index')->with('status', 'success')->with('content', 'Évènement ajouté');
    }



    public function edit(Request $request, $hashid) {
        return view('event.edit', [
            'event' => event::whereId(decodeId($hashid))->firstOrFail()
        ]);
    }

    public function update(Request $request, $hashid) {
        $event = event::whereId(decodeId($hashid))->firstOrFail();
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required',
            'dates' => ['required', 'regex:/[0-3][0-9]-[0-1][0-9]-[0-9][0-9][0-9][0-9]  à  [0-3][0-9]-[0-1][0-9]-[0-9][0-9][0-9][0-9]/i'],
            // 'date_start' => 'required',
            // 'date_end' => 'required',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $dates = explode('  à  ', request('dates'));
        $date_start = dateToTimestamp($dates[0], true);
        $date_end = dateToTimestamp($dates[1], true);
        // dd([Carbon::createFromTimestamp($date_start)->format('Y-m-d H:m:s')]);

        $event->title = request('title');
        $event->type = request('type');
        $event->date_start = $date_start;
        $event->date_end = $date_end;
        $event->description = request('description');
        $event->save();

        // dd([Carbon::createFromTimestamp($event->date_start)->format('Y-m-d H:m:s')]);

        return redirect()->route('event.index')->with('status', 'success')->with('content', 'Évènement modifié');
    }


    public function delete(Request $request, $hashid) {
        $event = event::whereId(decodeId($hashid))->firstOrFail();
        $event->delete();
        return redirect()->route('event.index')->with('status', 'success')->with('content', 'Évènement supprimé');
    }
}
