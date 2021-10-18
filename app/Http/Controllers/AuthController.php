<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function getRegisterForm() 
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $newUser = User::create($data);

        auth()->login($newUser);

        return redirect('/posts');
    }

    public function logout() 
    {
        auth()->logout();

        return redirect('/login');
    }

    public function getLoginBlade()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (auth()->attempt($credentials)) {
            return redirect('/posts');
        }

        return view('auth.login', [ 'invalid_credentials' => true ]);
    }
}
