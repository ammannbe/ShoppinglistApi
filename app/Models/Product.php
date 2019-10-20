<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'name',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'name',
        'is_public',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_email' => 'string',
        'name' => 'string',
        'is_public' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_public',
    ];

    /**
     * The resource is public (no user owns it).
     */
    public function getIsPublicAttribute()
    {
        return $this->attributes['owner_email'] === null;
    }

    /**
     * QueryFilter for personal or public resources.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\User  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePersonalOrPublic(Builder $query, User $user): Builder
    {
        $email = $user->email;
        return $query->where(function ($q) use ($email) {
            $q->where('owner_email', $email);
            $q->orWhere('owner_email', null);
        });
    }
}
