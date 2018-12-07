<?php

namespace App;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;

class Order_status extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_status';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'update_at'];

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
    protected $dates = ['update_at'];

    public function orders(){
        return $this->belongsTo(Orders::class,"order_id");
    }

}