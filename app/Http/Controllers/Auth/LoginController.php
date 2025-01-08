<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Point to your login view
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request, Google2FA $google2fa)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'two_factor_code' => 'required|digits:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $secret = $user->google2fa_secret; // Retrieve the stored secret key

            $isValid = $google2fa->verifyKey($secret, $request->input('two_factor_code'));

            if ($isValid) {
                // 2FA code is valid, proceed to dashboard
                return redirect()->intended('/dashboard');
            } else {
                // 2FA code is invalid, show error message
                Auth::logout();
                return back()->withErrors(['two_factor_code' => 'The provided 2FA code is invalid.']);
            }
        

            // Regenerate the session and redirect based on role
            $request->session()->regenerate();
            return $this->handleRedirect($user);
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Log out the user and redirect back with an error message.
     */
    protected function logoutAndRedirect(Request $request, $errorMessage)
    {
        Auth::logout(); // Log out the user
        return back()->withErrors([
            '2fa_code' => $errorMessage,
        ])->withInput($request->except('password'));
    }

    /**
     * Redirect user based on their role.
     */
    protected function handleRedirect($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'customer':
                return redirect()->route('customer.dashboard');
            default:
                return redirect('/'); // Fallback to home or a default page
        }
    }

    /**
     * Log the user out and invalidate the session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the token to prevent reuse
        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect back to login
    }
}
