<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Http\Request;


class authController extends Controller
{
   public function register(userRequest $request){
    $validated = $request->validated();
    $user = User::create($validated);
    return redirect()->route('auth.login');
   }

   public function login(userRequest $request){
    $credentials = $request->validated();
     if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('books.index'));
        }
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
   }

   public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('auth.login');
   }

}
