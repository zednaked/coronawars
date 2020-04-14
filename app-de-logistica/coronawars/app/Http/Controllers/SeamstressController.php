<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seamstress;

class SeamstressController extends Controller
{
    public function post(Request $request,$id=NULL)
    {
    	$arr = $request->except(['_token','city_country']);
		$seamstress = NULL;

    	if($id != NULL)
			$seamstress = Seamstress::find($id);
		else
			$seamstress = new Seamstress;
		
		$seamstress->fill($arr);
		$seamstress->save();

        return redirect()->to(route('list-seamstresses'));
    }

    public function list(){
        $requests = Seamstress::orderBy('name')->paginate(50);

        return view('seamstress.list-seamstresses')->with(['seamstresses'=>$requests]);
    }
    public function delete($id){
        $seamstress = Seamstress::find($id);
        $seamstress->delete();

        return redirect()->to(route('list-seamstresses'));
    }
    public function get($seamstress_id=null){
        $entity = Seamstress::whereId($seamstress_id)->first();
        if( $entity == NULL )
        	$entity = new Seamstress;

        return view('seamstress.seamstress')->with(['seamstress'=>$entity]);
    }
}
