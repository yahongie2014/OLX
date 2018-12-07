<?php

namespace App\Models;

use App\Order_status;
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
    protected $fillable = ['status', 'order_status_update','user_id', 'order_number', 'promo_code_id', 'total', 'deleted_at'];

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
    protected $casts = [
        'order_status_update' => 'date:hh:mm'
    ];

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

        return $this->hasMany(OrderItmes::class,"order_id");

    }
    public function orders_product_company(){

        return $this->morphMany(AdsProducts::class,Products::class,"product_id","id","product_id");

    }
    public function status(){
        return $this->hasMany(Order_status::class,"id");
    }


}
