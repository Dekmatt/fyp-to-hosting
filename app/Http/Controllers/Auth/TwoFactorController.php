<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Google2FA;

class TwoFactorController extends Controller
{
    // Show the 2FA setup page with QR code and secret key
    public function show(Google2FA $google2fa)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Generate a secret key for the user
        $secret = $google2fa->generateSecretKey();

        // Save the secret key to the user's record
        $user->google2fa_secret = $secret;
        $user->save();

        // Generate the QR code URL
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'), // Application Name
            $user->email,       // User's email
            $secret             // Secret key
        );

        // Pass the QR code URL and secret to the view
        return view('auth.2fa', [
            'qrCodeUrl' => $qrCodeUrl,
            'secret' => $secret,
        ]);
    }

    // Verify the 2FA code
    public function verify(Request $request, Google2FA $google2fa)
    {
        $request->validate([
            '2faCode' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $secret = $user->google2fa_secret; // Retrieve the stored secret key

        // Debugging statements
        \Log::info('Secret Key: ' . $secret);
        \Log::info('2FA Code: ' . $request->input('2faCode'));

        $isValid = $google2fa->verifyKey($secret, $request->input('2faCode'));

        if ($isValid) {
            // 2FA code is valid, proceed to login page
            return redirect()->intended('/login');
        } else {
            // 2FA code is invalid, show error message
            return back()->with('error', '2FA code is incorrect, scan back for new code');
        }
    }
}