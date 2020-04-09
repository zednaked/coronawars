<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SeamstressRequest;

class SeamstressRequestConciliation extends Model
{
	protected $table = 'seamstress_request_conciliation';
	
    public function seamstress_request()
    {
        return $this->belongsTo(SeamstressRequest::class);
    }
}
