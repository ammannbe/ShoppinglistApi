<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shopping_list_id',
        'product_id',
        'unit_id',
        'user_id',
        'amount',
        'done',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'shoppingList',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
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

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'shopping_list_id' => $this->shopping_list_id,
            'product' => $this->product,
            'unit' => $this->unit,
            'user' => $this->user,
            'amount' => $this->amount,
            'done' => $this->done,
        ];
    }
}
