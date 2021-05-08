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

    public function equipe(Request $request) {
        return view('user.equipe', [
            'users' => User::admin()->inRandomOrder()->get()
        ]);
    }

    public function show(Request $request, $hashid) {
        return view('user.show', [
            'user' => User::where('id', decodeId($hashid))->firstOrFail()
        ]);
    }

    public function edit(Request $request, $hashid) {
        $user = User::where('id', decodeId($hashid))->firstOrFail();
        if($user->id == Auth::id()) return redirect()->route('profil.edit');
        return view('user.edit', [
            'user' => $user
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

        if(!request('role')) {
            $roles = ["user"];
        } else {
            $roles = array_keys(request('role'));
        }
        $user->role = json_encode($roles);

        if(request('img') && $user->hasRole('admin')) {
            // File::delete(public_path().$user->img);
            
            // $imageName = 'img.'.strtolower(request('img')->getClientOriginalExtension());
            // $path = '/assets/galleries/'.$user->hashId.'/';
            // request('img')->move(public_path($path), $imageName);

            // $user->img = $path.$imageName;
            
            $path = '/assets/profiles/';
            if($user->img !== '/assets/profiles/user.png') {
                File::delete(public_path($user->img));
            }
            
            $imageName = $user->hashid.'.'.request('img')->getClientOriginalExtension();
            request('img')->move(public_path($path), $imageName);

            $user->img = $path.$imageName;

            // resize_image($user->img, 1024);
            compress_image($user->img, 30);

            // if(Config::get('compress_photos') == 'oui') {
            //     compress_image($user->img, 'high');
            //     compress_image($user->img, 'medium');
            //     compress_image($user->img, 'low');
            // }
        } 

        $user->name = request('name');
        $user->bio = request('bio');
        $user->save();
        
        return redirect()->route('user.index')->with('status', 'success')->with('content', 'Profil modifié');;
    }

    public function delete(Request $request, $hashid) {
        $user = User::where('id', decodeId($hashid))->firstOrFail();

        $user->delete();
        
        return redirect()->route('user.index', $user->hashid)->with('status', 'success')->with('content', 'Utilisateur supprimé');;
    }
}
