<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\Auth\Token;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Auth\Token  $request
     * @return array
     */
    public function store(Token $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !\Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken($request->device_name)->plainTextToken];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return void
     */
    public function destroy()
    {
        /** @var \Laravel\Sanctum\PersonalAccessToken $token */
        $token = auth()->user()->currentAccessToken();
        $token->delete();
    }
}
