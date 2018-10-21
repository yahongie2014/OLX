<?php

namespace App\Models;

use App\Http\Resources\OrdersItemsApi;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    const CREATED_AT = 'created_at';
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'user_id', 'order_number', 'promo_code_id', 'total', 'deleted_at'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'expires_at', 'expires_at', 'expires_at', 'deleted_at', 'deleted_at'];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function Items(){
        return $this->hasMany(OrderItmes::class,"user_id");
    }


}
