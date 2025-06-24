<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.reports.index');
            }
            
            // If not admin, logout and return with error
            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have admin privileges.',
            ])->withInput();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
}
