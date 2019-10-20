<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Verify the email address
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, string $email)
    {
        try {
            $user = User::findOrFail($email);

            if (! hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
                throw new \Exception('Hash does not match.');
            }

            if ($user->hasVerifiedEmail()) {
                throw new \Exception('Email address is already verified.');
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }

            return response()->view('auth.register.verified', [], 200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return response()->view('auth.register.verify-failed', [], 400);
        }
    }

    /**
     * Check if email is verified or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $verified = false;
        if ($request->user()->hasVerifiedEmail()) {
            $verified = true;
        }
        return response(['verified' => $verified]);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response(['message' => 'Die E-Mail Adresse ist bereits verifiziert'], 422);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response(['message' => 'Die Verifizierungs E-Mail wurde erneut versendet.']);
    }

}
