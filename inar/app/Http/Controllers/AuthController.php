<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        $authUser = User::updateOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'name' => $user->getName(),
                'password' => bcrypt(str_random(16))
            ]
        );

        Auth::login($authUser, true);

        return redirect('/home');
    }
}
