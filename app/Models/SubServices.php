<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubServices extends Model
{
    use SoftDeletes, Translatable;
    public $useTranslationFallback = true;
    public $translationModel = SubServicesTranslation::class;
    public $translatedAttributes = ['name', 'desc'];
    const CREATED_AT = 'created_at';
    // protected $dateFormat = 'U';
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_services';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active', 'services_id', 'deleted_at'];

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

    public function services(){

        return $this->belongsTo(Services::class,"services_id");
    }

}
