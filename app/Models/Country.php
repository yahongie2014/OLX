<?php

namespace App\Models;

use App\Cities;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes, Translatable;

    public $timestamps = true;
    public $useTranslationFallback = true;
    public $translationModel = CountriesTranslation::class;
    public $translatedAttributes = ['name','countries_id'];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active', 'code', 'deleted_at'];

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

    protected $with = ['translations'];

    public function cities(){
        return $this->hasMany(Cities::class);

    }


}
