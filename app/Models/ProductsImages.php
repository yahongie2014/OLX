<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_images';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'products_id', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ["deleted_at","created_at","updated_at"];

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
    protected $dates = ['deleted_at','expires_at'];

    public function ImgPro(){

        return $this->belongsTo(Products::class,"products_id");
    }


}
