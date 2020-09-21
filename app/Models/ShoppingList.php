<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\ShoppingList
 *
 * @property int $id
 * @property string $name
 * @property string $owner_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static Builder|ShoppingList hasAccess()
 * @method static Builder|ShoppingList isOwn()
 * @method static Builder|ShoppingList newModelQuery()
 * @method static Builder|ShoppingList newQuery()
 * @method static Builder|ShoppingList query()
 * @method static Builder|ShoppingList whereCreatedAt($value)
 * @method static Builder|ShoppingList whereId($value)
 * @method static Builder|ShoppingList whereName($value)
 * @method static Builder|ShoppingList whereOwnerEmail($value)
 * @method static Builder|ShoppingList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShoppingList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
        'owner_email',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'owner_email' => 'string',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isOwnOrHasAccess', function (Builder $query) {
            return $query->where(function (Builder $q) {
                return $q->isOwn();
            })->orWhere(function (Builder $q) {
                return $q->hasAccess();
            });
        });
    }

    /**
     * Get only the shopping lists of the logged in user
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsOwn(Builder $builder): Builder
    {
        return $builder->whereOwnerEmail(auth()->id());
    }

    /**
     * Get the shopping lists the user has access to
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasAccess(Builder $builder): Builder
    {
        return $builder->whereHas('users', function ($q) {
            $q->where('user_email', auth()->id());
        });
    }

    /**
     * Get the owner of this shopping list
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get users corresponding to this shopping list
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * Get users corresponding to this shopping list
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany('App\Models\Item');
    }

    /**
     * Check if the user has access to the resource
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function hasUser(User $user): bool
    {
        return $this->users()->whereEmail($user->email)->exists();
    }
}
