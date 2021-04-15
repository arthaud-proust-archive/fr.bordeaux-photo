<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use App\Models\Page;
use Validator;
use Response;

class InfoController extends Controller
{
    public function home() {
        if($home = Page::firstWhere('url', '/')) {
            return view('page.show', [
                'page' => Page::firstWhere('url', '/'),
                'infos' => Info::page($home->hashid)->orderBy('id', 'desc')->get()
            ]);
        } else {
            return view('home', [
                'infos' => Info::orderBy('id', 'desc')->get()
            ]); 
        }
    }

    public function create() {
        return view('info.create', [
            'pages' => Page::select(['title', 'id', 'url'])->get()->append('hashid')
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'pages' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $info = info::create([
            'title' => request('title'),
            'content' => request('content'),
            'pages' => json_encode(array_keys(request('pages')))
        ]);
        return redirect()->route('page.index')->with('status', 'success')->with('content', 'Info ajoutée');
    }



    public function edit(Request $request, $hashid) {
        return view('info.edit', [
            'info' => info::whereId(decodeId($hashid))->firstOrFail(),
            'pages' => Page::select(['title', 'id', 'url'])->get()->append('hashid')
        ]);
    }

    public function update(Request $request, $hashid) {
        $info = info::whereId(decodeId($hashid))->firstOrFail();
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'pages' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $info->title = request('title');
        $info->content = request('content');
        $info->pages = json_encode(array_keys(request('pages')));
        $info->save();

        return redirect()->route('page.index')->with('status', 'success')->with('content', 'Info modifiée');
    }


    public function delete(Request $request, $hashid) {
        $info = info::whereId(decodeId($hashid))->firstOrFail();
        $info->delete();
        return redirect()->route('page.index')->with('status', 'success')->with('content', 'Info supprimée');
    }
}