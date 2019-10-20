<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'email';

    /**
     * The "type" of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'email',
        'updated_at',
        'created_at',
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

    /**
     * Get the products corresponding to this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany('App\Models\Product', 'owner_email');
    }

    /**
     * QueryFilter exclude User by email
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $email
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExceptUser(Builder $query, string $email): Builder
    {
        return $query->where('email', '!=', $email);
    }

    /**
     * Determine if this user is the owner of the model
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model  The model with a attribute "owner_email"
     * @return bool
     */
    public function isOwnerOf(Model $model): bool
    {
        return $this->email === $model->owner_email;
    }
}
