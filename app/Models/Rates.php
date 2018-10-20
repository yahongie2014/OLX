<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rates extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rates';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ads_id', 'user_id', 'user_type', 'average', 'deleted_at'];

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
    protected $casts = ["user_type" => "boolean"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'expires_at'];

    public function ads(){

        return $this->belongsTo(Advertising::class,"ads_id");
    }
    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }


}
