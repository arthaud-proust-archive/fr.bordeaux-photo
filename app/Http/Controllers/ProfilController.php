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
            return view('profil.show', [
                'user' => User::where('id', decodeId($hashid))->firstOrFail()
            ]);

        } else {
            return view('profil.show', [
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

        return redirect()->route('profil.show');
    }
}
