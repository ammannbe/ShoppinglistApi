<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Update;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response(auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request)
    {
        return auth()->user()->update($request->only(['email', 'password']));
    }
}
