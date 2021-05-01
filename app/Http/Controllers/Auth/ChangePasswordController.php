<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\Auth;

use App\Rules\OldPwd;

class ChangePasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.change-password');
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', new OldPwd],
            'password' => 'required|string|confirmed|different:old_password',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        Auth::user()->fill([
            'password' => Hash::make(request('password'))
        ])->save();
        
        return redirect()->route('profil.show')->with('status', 'success')->with('content', 'Mot de passe changé');
    }
}
