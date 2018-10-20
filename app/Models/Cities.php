<?php

namespace App;

use App\Models\CitiessTranslation;
use App\Models\Country;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model  {

    use SoftDeletes, Translatable;

    public $translationModel = CitiessTranslation::class;
    public $translatedAttributes = ['name','cities_id'];

    const CREATED_AT = 'created_at';
    public $timestamps = true;

    protected $with = ['translations'];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active', 'country_id', 'deleted_at'];

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
    protected $casts = ["is_active" => "boolean"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function country(){

        return $this->belongsTo(Country::class,"country_id");
    }

}