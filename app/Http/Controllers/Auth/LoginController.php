<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Add this line
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
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'two_factor_code' => 'required|digits:6', // Make sure 2FA code is a 6-digit number
    ]);

    // Validate the reCAPTCHA response with custom message
    $validator = Validator::make($request->all(), [
        'g-recaptcha-response' => 'required|captcha',
    ], [
        'g-recaptcha-response.required' => 'CAPTCHA not Verified',
        'g-recaptcha-response.captcha' => 'Invalid reCaptcha response',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Attempt to authenticate the user with email and password
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $user = Auth::user();
        $secret = $user->google2fa_secret; // Retrieve the stored secret key for 2FA

        // Verify the 2FA code
        $isValid = $google2fa->verifyKey($secret, $request->input('two_factor_code'));

        if ($isValid) {
            // 2FA code is valid, proceed to dashboard
            $request->session()->regenerate(); // Regenerate session for security
            return $this->handleRedirect($user); // Redirect based on role
        } else {
            // 2FA code is invalid, log the user out and show error message
            Auth::logout();
            return back()->withErrors(['two_factor_code' => 'The provided 2FA code is invalid.']);
        }
    }

    // Authentication failed, show error message
    return redirect()->back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput($request->except('password'));
}

    /**
     * Redirect user based on their role.
     */
    protected function handleRedirect($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard'); // Admin dashboard
            case 'staff':
                return redirect()->route('staff.dashboard'); // Staff dashboard
            case 'customer':
                return redirect()->route('dashboard'); // Customer dashboard
            default:
                return redirect('/'); // Fallback to home or a default page
        }
    }

    /**
     * Log the user out and invalidate the session.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        // Invalidate the session and regenerate the token to prevent reuse
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect back to login
    }
}