<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if (!$user) {
                $user = User::where('email', $facebookUser->email)->first();
                
                if (!$user) {
                    $user = User::create([
                        'name' => $facebookUser->name,
                        'email' => $facebookUser->email,
                        'password' => Hash::make(uniqid()),
                        'facebook_id' => $facebookUser->id,
                        'facebook_token' => $facebookUser->token,
                    ]);
                    $user->assignRole('Customer');
                } else {
                    $user->update([
                        'facebook_id' => $facebookUser->id,
                        'facebook_token' => $facebookUser->token,
                    ]);
                }
            }

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Facebook login failed. Please try again.']);
        }
    }
} 