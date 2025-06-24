<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //This method will show login page for customer
    public function index() {
        return view('login');
    }
    //This method will authenticate the user and it takes as input the html request as the variable $request
    public function authenticate(Request $request)
    {
        //First I will validate the form, this will check kai input fields correct format main likhi gayi hain ya nahi
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            //Checks the email and password from registered customers list in the database
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                //Now if everything is correct redirect customer to profile page
                return redirect()->route('admin.dashboard');
            }else {
            //Return Errors that login credentials are incorrect
            //Errors per customer login page per redirect and with sey hum nay session pass kiya hai k email or password incorrect hai
            return redirect()->route('admin.login')->with('error','Either email or password is incorrect.');
        }
    }
        //Agar Validator pass nahi hota toh account.login wala page dobara display hota with the pre-filled by user values and errors
        //withInput() say form ki values clear nahi hongi
        //withErrors say form main errors display honge
        else {
            return redirect()->route('admin.login')
                ->withInput()
                ->withErrors($validator);
        }
    }

    //This method will show register page
    public function register() {
        //Register.blade.php show krey
        return view('register');
    }
    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            //email field users yaani customers ke register kertay waqt humesha unique rahe gi
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'name' => 'required',
            'password_confirmation' => 'required',
        ]);

        if ($validator->passes()) {
            //Store customer in database after validation check(check if correct format of input fields)//
            //using User model//
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();
            //Display Login page with session message Success message after registering user
            return redirect()->route('admin.login')->with('success', 'You have been registered successfully.');

        }

        //Agar Validator pass nahi hota toh account.register wala page dobara display hota with the pre-filled by user values and errors
        //withInput() say form ki values clear nahi hongi
        //withErrors say form main errors display honge
        else {
            return redirect()->route('account.register')
                ->withInput()
                ->withErrors($validator);
        }
    }
    //Logout method
    public function logout() {
        Auth::logout();
        session()->invalidate();    // Invalidate the session
        session()->regenerateToken();    // Regenerate CSRF token
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
