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
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    /**
 * Handle an incoming authentication request.
 */
public function store(LoginRequest $request): RedirectResponse
{
    // Authenticate the user
    $request->authenticate();

    // Regenerate the session to prevent session fixation attacks
    $request->session()->regenerate();

    // Get the authenticated user
    $user = Auth::user();

    // Redirect based on user role
    switch ($user->role) {
        case 'staff':
            return redirect()->route('staff.dashboard'); // Redirect to staff dashboard

        case 'admin':
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard

        case 'customer':
        default:
            return redirect()->route('dashboard'); // Redirect to customer dashboard
    }
}
}