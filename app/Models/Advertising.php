<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertising extends Model
{
    use SoftDeletes, Translatable;
    public $useTranslationFallback = true;
    public $translationModel = AdvertisingTranslation::class;
    public $translatedAttributes = ['desc', 'is_delivery', 'percentage', 'locale'];
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    protected $dateFormat = 'U';

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
    protected $casts = ["is_active" => "boolean"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'deleted_at'];

}
