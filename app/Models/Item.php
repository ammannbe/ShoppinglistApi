<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $shopping_list_id
 * @property string $product_name
 * @property string|null $unit_name
 * @property string $creator_email
 * @property int|null $amount
 * @property bool $done
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\ShoppingList $shoppingList
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereShoppingListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnitName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shopping_list_id',
        'product_name',
        'unit_name',
        'creator_email',
        'amount',
        'done',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'product_name',
        'unit_name',
        'creator_email',
        'amount',
        'done',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'owner_email' => 'string',
        'shopping_list_id' => 'integer',
        'product_name' => 'string',
        'unit_name' => 'string',
        'creator_email' => 'string',
        'amount' => 'integer',
        'done' => 'boolean',
    ];

    /**
     * Get shopping list corresponding to this item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo('App\Models\ShoppingList');
    }

    /**
     * Get shopping list corresponding to this item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
