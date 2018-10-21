<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'languages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'symbol' , 'direction' , 'status' , 'default'
    ];

    public function users() {

        return $this->hasMany(User::class);
    }

}
