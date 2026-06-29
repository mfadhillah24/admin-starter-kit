<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            
            'title' => 'login',
        ]);
    }
    /**
     * Handle an authentication attempt.
     */
   public function authenticate(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return to_route('dashboard.index')->withSuccess('You are logged in!');
    
    }

    
    return back()->with('error', 'The provided credentials do not match our records.')->withInput();
}
public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/')->withSuccess('You have been logged out!');
}
}