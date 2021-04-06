<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfilController extends Controller
{
    public function show(Request $request, $hashid=null) {
        if($hashid) {
            return view('user.show', [
                'user' => User::where('id', decodeId($hashid))->firstOrFail()
            ]);

        } else {
            return view('user.show', [
                'user' => Auth::user()
            ]); 
        }
    }

    public function edit(Request $request) {
        return view('profil.edit', [
            'user' => Auth::user()
        ]); 
    }


    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255','unique:users,name,'.Auth::id()],
            'bio' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $user = User::whereId(Auth::id())->firstOrFail();
        $user->name = request('name');
        $user->bio = request('bio');
        $user->save();

        return redirect()->route('profil.show');
    }
}
