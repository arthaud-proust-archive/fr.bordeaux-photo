<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request) {
        return view('user.index', [
            'users' => User::all()
        ]);
    }

    public function show(Request $request, $hashid) {
        return view('user.show', [
            'user' => User::where('id', decodeId($hashid))->firstOrFail()
        ]);
    }

    public function edit(Request $request, $hashid) {
        return view('user.edit', [
            'user' => User::where('id', decodeId($hashid))->firstOrFail()
        ]);
    }


    public function update(Request $request, $hashid) {
        $user = User::where('id', decodeId($hashid))->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255','unique:users,name,'.$user->id],
            'bio' => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $user->name = request('name');
        $user->role = request('role');
        $user->bio = request('bio');
        $user->save();
        
        return redirect()->route('user.show', $user->hashid)->with('status', 'success')->with('content', 'Profil modifié');;
    }

    public function delete(Request $request, $hashid) {
        $user = User::where('id', decodeId($hashid))->firstOrFail();

        $user->delete();
        
        return redirect()->route('user.list', $user->hashid)->with('status', 'success')->with('content', 'Utilisateur supprimé');;
    }
}
