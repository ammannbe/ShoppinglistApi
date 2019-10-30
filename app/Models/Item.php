<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
