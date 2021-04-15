<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Info;
use Validator;
use Response;

class PageController extends Controller
{

    public function index(Request $request) {
        return view('page.index', [
            'pages' => Page::all()
        ]);
    }

    public function show(Request $request, $url) {
        $url = '/'.$url;
        $page = Page::where('url', $url)->firstOrFail();
        return view('page.show', [
            'page' => $page,
            'infos' => Info::page($page->hashid)->get()
        ]);
    }

    public function create() {
        return view('page.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:255','unique:pages,title'],
            'url' => ['required','string','max:255','unique:pages,url'],
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $page = page::create([
            'title' => request('title'),
            'url' => str_starts_with(request('url'), '/')? request('url'):'/'.request('url'),
            'description' => request('description')
        ]);

        return redirect()->route('page.index')->with('status', 'success')->with('content', 'Page ajoutée');
    }

    public function edit(Request $request, $hashid) {
        return view('page.edit', [
            'page' => Page::where('id', decodeId($hashid))->firstOrFail()
        ]);
    }

    public function update(Request $request, $hashid) {
        $page = Page::where('id', decodeId($hashid))->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:255','unique:pages,title,'.$page->id],
            'url' => ['required','string','max:255','unique:pages,url,'.$page->id],
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        $page->title = request('title');
        $page->url = str_starts_with(request('url'), '/')? request('url'):'/'.request('url');
        $page->description = request('description');
        $page->save();

        return redirect()->route('page.index')->with('status', 'success')->with('content', 'Page modifiée');
    }

    public function delete(Request $request, $hashid) {
        $page = Page::where('id', decodeId($hashid))->firstOrFail();

        $page->delete();

        return redirect()->route('page.index')->with('status', 'success')->with('content', 'Page suprimée');
    }
}
