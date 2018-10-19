<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompainesTranslation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'compaines_translations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'desc', 'address', 'company_number', 'city_id', 'service_id', 'compaines_id', 'locale', 'deleted_at'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at'];


}
