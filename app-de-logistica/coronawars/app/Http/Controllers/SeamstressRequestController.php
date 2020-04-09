<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeamstressRequest;
use App\Seamstress;
use App\SeamstressRequestConciliation;
use Carbon\Carbon;

class SeamstressRequestController extends Controller
{
    public function get($id=NULL){
        $request = NULL;
        if($id == NULL)
            $request = new SeamstressRequest;
        else
            $request = SeamstressRequest::find($id);
        $seamstresses = Seamstress::all();

        return view('seamstress.seamstress-request')->with(['request'=>$request,'seamstresses'=>$seamstresses]);
    }
    public function list(Request $request){

        $requests = SeamstressRequest::orderBy('delivered_at')->orderBy('created_at');

        if($request->input('pendingConciliation') == true)
            $requests = $requests
                                ->whereNotNull('delivered_at')
                                ->whereNull('archived_at');
        else if($request->input('toBeDelivered') == true)
            $requests = $requests->whereNull('delivered_at');
        else if($request->input('onlyArchived') == true ) 
            $requests = $requests->whereNotNull('archived_at');
        else if($request->input('all') != true ) 
            $requests = $requests->whereArchivedAt(NULL);

        $requests = $requests->paginate(50);

        return view('seamstress.list-seamstress-request')->with(['requests'=>$requests]);
    }

    public function post(Request $request, $id=NULL)
    {
    	$arr = $request->except(['_token']);
        $request = NULL;

    	if($id != NULL)
			$request = SeamstressRequest::find($id);
		else
			$request = new SeamstressRequest;
		
		$request->fill($arr);
        $request->seamstress_id = $arr['seamstresser_id'];
        $request->save();

        return redirect()->to(route('list-supply-request'));
    }

    public function markAsDelivered(Request $request, $id=NULL){
        $request = SeamstressRequest::find($id);
        $request->delivered_at = Carbon::now();
        $request->save();

        return redirect()->to(route('list-supply-request'));
    }
    public function conciliate($id,$masks_received){
        if($masks_received < 0 ) 
            return redirect()->to(route('list-supply-request'))->with('status','Error');

        $request = SeamstressRequest::find($id);
        if($request == NULL ) 
            return redirect()->to(route('list-supply-request'))->with('status','Error');

        $conciliation = new SeamstressRequestConciliation;
        $conciliation->masks_received = $masks_received;
        $request->conciliations()->save($conciliation);
        $request->save();

        return redirect()->to(route('list-supply-request'))->with('highlight',$id);
    }
    public function archive($id,$activate=false){
        $request = SeamstressRequest::find($id);
        if(!$activate)
            $request->archived_at = Carbon::now();
        else 
            $request->archived_at = NULL;

        $request->save();
        return redirect()->to(route('list-supply-request'))->with('status', $activate ? 'Item re-activated' : 'Item archived');   
    }
}
