<?php

namespace App\Http\Controllers;

use Exception;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
            if ($isUser) {
                Auth::login($isUser);
                return redirect('/dashboard');
            } else {
                echo $user->id;
                $exits = User::where('email', $user->email)->first();
                if ($exits) {
                    $exits->fb_id = $user->id;
                    $exits->save();
                    Auth::login($exits);
                    return redirect('/dashboard');
                }
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('')
                ]);
                Auth::login($createUser);
                return redirect('/dashboard');
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
