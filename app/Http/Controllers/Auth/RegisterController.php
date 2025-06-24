<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        // Remove the guest middleware to prevent automatic redirects
        // $this->middleware('guest')->except('logout');
    }

    public function showRegistrationForm()
    {
        // Only show registration form when explicitly requested through the register button
        if (request()->is('register') && request()->method() === 'GET' && request()->headers->get('referer')) {
            return view('customer.register');
        }
        
        // If someone tries to access register page directly or through unwanted redirects
        return redirect('/');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'city' => 'required',
            'password' => 'required|string|min:8',
            'address' => 'required|string',
            'guarantor_name' => 'required|string|max:255',
            'guarantor_phone' => 'required|string|max:20',
            'guarantor_address' => 'required|string',
            'guarantor_cnic' => 'required|string|max:15',
            'bank_name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch_code' => 'required|string|max:20',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'number' => $validated['phone'],  // Note: changed from 'phone' to 'number' to match model
                'city' => $validated['city'],
                'password' => Hash::make($validated['password']),
                'address' => $validated['address'],
                'role' => 'customer',
                'guarantor_name' => $validated['guarantor_name'],
                'guarantor_phone' => $validated['guarantor_phone'],
                'guarantor_address' => $validated['guarantor_address'],
                'guarantor_cnic' => $validated['guarantor_cnic'],
                'bank_name' => $validated['bank_name'],
                'account_name' => $validated['account_name'],
                'account_number' => $validated['account_number'],
                'branch_code' => $validated['branch_code'],
            ]);

            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please try again. Error: ' . $e->getMessage())
                        ->withInput();
        }
    }
}