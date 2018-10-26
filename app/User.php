<?php

namespace App;
use App\Models\Message;
use App\Models\OrderItmes;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable  {
    use HasApiTokens, Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','image', 'email', 'city_id','phone', 'password', 'longitude', 'latitudes', 'activation_code', 'is_verify', 'is_admin', 'is_vendor', 'remember_token', 'deleted_at'];

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
    protected $dates = ['expires_at','deleted_at'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function city(){
        return $this->belongsTo(Cities::class,"city_id");
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
    public function firebase_tokens()
    {
        return $this->hasMany(UserFireBaseToken::class);
    }
    public function user(){

        return $this->hasMany(Orders::class);
    }



}