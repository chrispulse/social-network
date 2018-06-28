<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        $user = User::where('email','=', $githubUser->getEmail())->first();

        if ($user === null) {
            $data = [
                'email' => $githubUser->getEmail(),
                'name' => $githubUser->getNickName(),
                'password' => ''
            ];

            // Create new user based on github user
            $user = User::firstOrCreate($data);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
