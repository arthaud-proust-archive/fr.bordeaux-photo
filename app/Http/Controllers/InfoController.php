<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use Validator;
use Response;

class InfoController extends Controller
{
    public function home() {
        return view('home', [
            'infos' => Info::all()
        ]);
    }

    public function create() {
        return view('info.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $info = info::create([
            'title' => request('title'),
            'content' => request('content'),
        ]);
        return redirect()->route('home')->with('status', 'success')->with('content', 'Info ajoutée');
    }



    public function edit(Request $request, $hashid) {
        return view('info.edit', [
            'info' => info::whereId(decodeId($hashid))->firstOrFail()
        ]);
    }

    public function update(Request $request, $hashid) {
        $info = info::whereId(decodeId($hashid))->firstOrFail();
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $info->title = request('title');
        $info->content = request('content');
        $info->save();

        return redirect()->route('home')->with('status', 'success')->with('content', 'Info modifiée');
    }


    public function delete(Request $request, $hashid) {
        $info = info::whereId(decodeId($hashid))->firstOrFail();
        $info->delete();
        return redirect()->route('home')->with('status', 'success')->with('content', 'Info supprimée');
    }
}