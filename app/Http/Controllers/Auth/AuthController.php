<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
 	public function redirectToProvider($provider) {

        return Socialite::driver($provider)->redirect();

    }

 	public function handleProviderCallback($provider) {

        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        // $authUser->generateToken();

        return redirect('/home');

    }

    public function findOrCreateUser($user, $provider) {

        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);

    }
}
