<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seamstress;
use App\SeamstressRequestConciliation;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeamstressRequest extends Model
{
    use SoftDeletes;

	protected $table = 'seamstress_request';
	protected $fillable = ['masks_cut','elastic','thread','other','seamstress_id'];
    protected $dates = ['delivered_at','deleted_at'];

    /*
    $table->increments('id');
    $table->integer('masks_cut');
    $table->integer('elastic');
    $table->integer('thread');
    $table->timestamp('delivered_at')->nullable(true);
    */
	public function seamstress()
    {
        return $this->belongsTo(Seamstress::class);
    }
    public function conciliations()
    {
        return $this->hasMany(SeamstressRequestConciliation::class,'seamstress_request_id','id');
    }
}
