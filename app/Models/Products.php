<?php

namespace App\Models;

use App\User;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes, Translatable;
    public $useTranslationFallback = true;
    public $translationModel = ProductsTranslation::class;
    public $translatedAttributes = ['name', 'desc', 'price'];

    protected $with = ['translations'];
    const CREATED_AT = 'created_at';
   // protected $dateFormat = 'U';
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active', 'cover_image','user_id'];

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
    protected $dates = [ 'deleted_at', 'expires_at'];

    public function images(){

        return $this->hasMany(ProductsImages::class,"products_id","id");
    }

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }

}
