<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontend.signup');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => 'nullable|string|max:15',  // Validate phone number (optional)
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:booker,organizer',  // Only allow 'booker' and 'organizer'

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,  // Save phone number
            'password' => Hash::make($request->password),
            'role' => $request->role,  // Save the role (booker or organizer)
        ]);

        event(new Registered($user));

        Auth::login($user);

        return $this->redirectUserBasedOnRole($user);
    }
    protected function redirectUserBasedOnRole($user)
    {
        if ($user->role === 'organizer') {
            return redirect()->route('organizer.dashboard');  // Redirect to organizer dashboard
        }

        return redirect()->route('booker.eventlist');  // Redirect to event list for booker
    }
}
