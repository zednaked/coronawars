<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seamstress extends Model
{
	protected $table = 'seamstress';
    protected $fillable = ['address','email','phone_number','name'];
    /*
    $table->string('address',1000);
    $table->float('geo_lon', 3, 8);  
    $table->float('geo_lat', 3, 8);  
    $table->string('email',50);
    $table->string('phone_number',50);
    $table->string('name',50);
    $table->timestamps();
    */
    public function requests()
    {
        return $this->hasMany('App\SeamstressRequests');
    }
}
