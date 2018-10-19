<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItmes extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_itmes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'order_id', 'order_long', 'order_lat', 'qty', 'price', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'expires_at', 'expires_at', 'expires_at', 'deleted_at'];
}
