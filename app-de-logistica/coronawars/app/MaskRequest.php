<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaskRequest extends Model
{
	protected $table = 'maskrequest';
	
    protected $fillable = [
        'requested_by_user_id', 'address', 'city_country','reason','masks','shields','email','name','phone_number'
    ];

    protected $dates = ['delivered_at'];
}
