<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthentificationController extends Controller
{
    // Show the sign-in form
    public function showSigninForm()
    {
        return view('frontend.signin');
    }

    // Handle the sign-in process
    public function signin(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            "email" => "required|email|max:255",
            "password" => "required|string|min:8"
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            // If authentication is successful, regenerate the session
            $request->session()->regenerate();

            // Get the logged-in user
            $user = Auth::user();

            // Redirect to the appropriate dashboard based on user role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'organizer') {
                return redirect()->route('organizer.dashboard');
            } elseif ($user->role === 'booker') {
                return redirect()->route('booker.eventlist');
            }

            // Fallback in case the role is not recognized
            return redirect()->route('login')->with('error', 'You are not authorized to access this page.');
        }

        // Redirect back to the sign-in form with an error message if authentication fails
        return redirect()->route('frontend.signin')->with('error', 'Invalid credentials, please try again.');
    }

    // Show the sign-up form
    public function showSignupForm()
    {
        return view('frontend.signup');
    }

    // Handle the sign-up process (now only for booker and organizer)
    public function signup(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|unique:users,email|max:255",
            "phone_number" => "required|string|max:20",
            'role' => 'required|in:booker,organizer', // Allow only booker or organizer roles
            "password" => "required|string|min:8|confirmed",
            "password_confirmation" => "required|string|same:password", // Fixed typo here
        ]);

        try {
            // Create a new user in the database
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'role' => $validated['role'],  // This will be either booker or organizer
                'password' => Hash::make($validated['password']),
            ]);

            // Log the user in after successful registration
            Auth::login($user);

            // Redirect to the appropriate dashboard based on the role
            if ($user->role === 'organizer') {
                return redirect()->route('organizer.dashboard');
            } elseif ($user->role === 'booker') {
                return redirect()->route('booker.eventlist');
            }

            // Fallback if no role matched
            return redirect()->route('login')->with('error', 'You are not authorized to access this page.');

        } catch (Throwable $th) {
            // Handle any errors that occur during registration
            return view('error.500')->with("error", 'An error occurred during registration.');
        }
    }
}
