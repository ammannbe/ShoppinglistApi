<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'pivot',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
    ];

    /**
     * Get the shopping lists corresponding to this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shoppingLists(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\ShoppingList');
    }
}
