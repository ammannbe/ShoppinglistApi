<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        if ($user->isDirty('email')) {
            $email = $user->getOriginal('email');
            \DB::table('personal_access_tokens')
                ->where([
                    'tokenable_type' => User::class,
                    'tokenable_id'   => $email,
                ])
                ->update(['tokenable_id' => $user->email]);
        }
    }
}
