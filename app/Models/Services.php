<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes, Translatable;
    public $useTranslationFallback = true;
    public $translationModel = ServicesTranslation::class;
    public $translatedAttributes = ['name', 'desc'];

    protected $with = ['translations'];

    const CREATED_AT = 'created_at';
    // protected $dateFormat = 'U';
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active','icon', 'longitude', 'latitudes', 'deleted_at'];

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
    protected $dates = ['expires_at','deleted_at'];

    public function sub_service(){
        return $this->hasMany(SubServices::class);
    }
}
