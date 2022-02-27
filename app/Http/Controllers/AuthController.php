<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
	{
    	return view('auth.register');
	}

	public function register(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' =>'required|confirmed|min:8',
		]);
		$user = User::add($request->all());
		$user->generatePassword($request->get('password'));
		Auth::login($user, true);

		return redirect()->route('chats.index');
	}

	public function loginForm()
	{
        return view('auth.login');
	}

	public function login(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if(Auth::attempt([
			'email' => $request->get('email'),
			'password' => $request->get('password')
		], $request->filled('remember')))
		{
            return redirect()->route('chats.index');
		}
		return redirect()->back()->with('status', 'Неправильный Email или пароль');
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('login');
	}
}
