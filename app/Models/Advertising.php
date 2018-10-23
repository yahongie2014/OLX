<?php

namespace App\Models;

use App\User;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertising extends Model
{
    use SoftDeletes, Translatable;

    public $useTranslationFallback = true;
    public $translationModel = AdvertisingTranslation::class;
    public $translatedAttributes = ['desc', 'is_delivery', 'percentage', 'locale'];
    const CREATED_AT = 'created_at';
    public $timestamps = true;

    protected $with = ['translations'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertisings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active', 'services_id', 'subservices_id', 'user_id', 'deleted_at'];

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
    protected $casts = ["is_active" => "boolean","is_delivery" => "boolean"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'deleted_at'];

    public function services(){

        return $this->belongsTo(Services::class,"services_id");
    }
    public function subservices(){

        return $this->belongsTo(SubServices::class,"subservices_id");
    }
    public function users(){

        return $this->belongsTo(User::class,"user_id");
    }
    public function images(){

        return $this->hasMany(AdsImages::class);
    }
    public function cities(){

        return $this->hasMany(AdsCities::class);
    }

    public function Adsproducts(){

        return $this->hasMany(Advertising::class);

    }





}
