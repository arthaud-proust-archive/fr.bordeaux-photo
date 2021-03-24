<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Validator;
use Response;

class EventController extends Controller
{
    public function index() {
        return view('event.index', [
            'events' => event::all()
        ]);
    }

    public function create() {
        return view('event.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $event = event::create([
            'title' => request('title'),
            'type' => request('type'),
            'date_start' => request('date_start'),
            'date_end' => request('date_end'),
            'description' => request('description'),
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
            'date_start' => 'required',
            'date_end' => 'required',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $event->title = request('title');
        $event->type = request('type');
        $event->date_start = request('date_start');
        $event->date_end = request('date_end');
        $event->description = request('description');
        $event->save();

        return redirect()->route('event.index')->with('status', 'success')->with('content', 'Évènement modifié');
    }


    public function delete(Request $request, $hashid) {
        $event = event::whereId(decodeId($hashid))->firstOrFail();
        $event->delete();
        return redirect()->route('event.index')->with('status', 'success')->with('content', 'Évènement supprimé');
    }
}
