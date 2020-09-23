<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\Update;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \App\Models\User
     */
    public function show()
    {
        return auth()->user();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\Update  $request
     * @return void
     */
    public function update(Update $request)
    {
        auth()->user()->update($request->validated());
    }
}
