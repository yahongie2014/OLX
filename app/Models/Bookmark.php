<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    const CREATED_AT = 'created_at';
    public $timestamps = true;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookmarks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ads_id', 'user_id', 'deleted_at'];

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
    protected $dates = ['deleted_at', 'deleted_at'];

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function services(){

        return $this->belongsTo(Advertising::class,"ads_id");
    }

}
