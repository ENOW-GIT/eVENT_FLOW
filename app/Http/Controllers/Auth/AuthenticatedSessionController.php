<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.signin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Check the user's role and redirect accordingly
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Redirect to the admin dashboard
            return redirect()->route('admin.dashboard');  // Assuming you have an admin dashboard route
        }

        if ($user->role === 'organizer') {
            // Redirect to the organizer's dashboard
            return redirect()->route('organizer.dashboard');  // Assuming you have an organizer dashboard route
        }
        if ($user->role === 'booker') {
            // Redirect to the booker's event list
            return redirect()->route('booker.eventlist');  // Assuming you have an events route for bookers
        }

        // Default fallback if no role matched (in case of error or undefined role)
        return redirect()->route('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Invalidate the session and regenerate token for security
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect the user to the homepage
        return redirect('/');
    }
}
