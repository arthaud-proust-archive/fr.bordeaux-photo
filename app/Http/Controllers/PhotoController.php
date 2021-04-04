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

class PhotoController extends Controller
{
    

    public function create(Request $request, $event_hashid=null) {
        if($photo = photo::where('event', $event_hashid)->where('author', Auth::user()->hashid)->first()) {
            return redirect()->route('photo.edit', $photo->hashid)->with('status', 'success')->with('content', 'Vous avez déjà ajouté une photo, modifiez-la');
        } 
        return view('photo.create', [
            'event' => $event_hashid,
            'events' => event::select('id','title')->open()->get()->append('hashid')->toArray()
            // 'events' => event::open()->append('hashid')->pluck('id')->toArray()
        ]);

    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'event' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if($photo = photo::where('event', request('event'))->where('author', Auth::user()->hashid)->first()) {
            return redirect()->route('photo.edit', $photo->hashid)->with('status', 'success')->with('content', 'Vous avez déjà ajouté une photo, modifiez-la');
        }

        $event = event::whereId(decodeId(request('event')))->firstOrFail();


        $photo = photo::create([
            'event' => request('event'),
            'photo' => '',
            'title' => request('title'),
            'author' => Auth::user()->hashid,
            // 'author_name' => Auth::user()->name,
            'notes' => '{}'
            // 'extension' => request('photo')->getClientOriginalExtension()
        ]);

        $ext = request('photo')->getClientOriginalExtension();
        $imageName = 'full.'.$ext;
        $path = '/assets/photos/'.$event->hashid.'/'.$photo->hashid.'/';

        $photo->photo = $path.$imageName;
        $photo->save();

        request('photo')->move(public_path($path), $imageName);

        return redirect()->route('event.show', $event->hashid)->with('status', 'success')->with('content', 'Photo envoyée');
    }


    public function edit(Request $request, $hashid) {
        $photo = photo::whereId(decodeId($hashid))->firstOrFail();
        return view('photo.edit', [
            'photo' => $photo,
            'event' => event::whereId(decodeId($photo->event))->firstOrFail()
        ]);
    }


    public function update(Request $request, $hashid) {
        $photo = photo::whereId(decodeId($hashid))->firstOrFail();

        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $event = event::whereId(decodeId($photo->event))->firstOrFail();

        $photo->title = request('title', $photo->title);
        if(request('photo')) {
            $ext = request('photo')->getClientOriginalExtension();
            $imageName = 'full.'.$ext;
            $path = '/assets/photos/'.$event->hashid.'/'.$photo->hashid.'/';
    
            $photo->photo = $path.$imageName;
            
            request('photo')->move(public_path($path), $imageName);
        }
        $photo->save();

        return redirect()->route('event.show', $event->hashid)->with('status', 'success')->with('content', 'Photo modifiée');
    }
}
