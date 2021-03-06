<?php

namespace App\Models;

use App\Cities;
use Illuminate\Database\Eloquent\Model;

class AdsCities extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ads_cities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ads_id', 'city_id'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at'];

    public function Adscity(){

        return $this->belongsTo(Advertising::class,"ads_id");
    }
    public function City(){
        return $this->belongsTo(Cities::class,"city_id");

    }

}
