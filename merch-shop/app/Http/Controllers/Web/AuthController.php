<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseLoginFormRequest;
use App\Http\Requests\BaseRegisterFormRequest;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function registerForm(){
        return view('auth.register');
    }

    public function login(BaseLoginFormRequest $request){
        $data = $request->validated();

        if(Auth::attempt($data, true)){
            $request->session()->regenerate();

            return redirect(route('profile'));
        }
        return back()->with([
            'email'=>'invalid'
        ]);
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(BaseRegisterFormRequest $request){
        $data = $request->validated();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('profile'));
    }
}
