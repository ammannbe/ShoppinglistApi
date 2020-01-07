<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Http\Requests\Auth\Login;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'refresh');
    }

    /**
     * Handle a login request to the application.
     *
     * @bodyParam  email     string  required  User email-adress  Example: hans@meier.ch
     * @bodyParam  password  string  required  User password      Example: mySuperSecretD
     * @bodyParam  remember  boolean           Long-life token    Example: 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Login $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response(__('Credentials incorrect!'), 401);
        }

        if ($request->remember) {
            Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(30));
        }
        $tokenResult = auth()->user()->createToken('API Token');
        $data = [
            'token'      => $tokenResult->accessToken,
            'expires_at' => $tokenResult->token->expires_at,
            'issued_at'  => Carbon::now(),
        ];

        return response($data, 200);
    }

    /**
     * Handle a login refresh request to the application.
     *
     * @authenticated
     * @bodyParam  remember  boolean  Create a long-life token  Example: 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function refresh(Request $request)
    {
        auth()->user()->token()->delete();

        if ($request->remember) {
            Passport::personalAccessTokensExpireIn(Carbon::now()->addDays(30));
        }

        $tokenResult = auth()->user()->createToken('API Token');
        $data = [
            'token'      => $tokenResult->accessToken,
            'expires_at' => $tokenResult->token->expires_at,
        ];

        return response($data, 200);
    }

    /**
     * Handle a logout request to the application.
     *
     * @authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->token()->delete();
    }
}
