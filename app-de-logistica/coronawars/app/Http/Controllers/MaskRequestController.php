<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MaskRequest;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;

class MaskRequestController extends Controller
{
	public function post(Request $request)
    {
    	$arr = $request->except('_token');
    	$arr['requested_by_user_id'] = Auth::user()->id;
    	MaskRequest::create($arr);

        return redirect()->to(route('home'));
    }

    public function listNotDelivered(){
        $requests = MaskRequest::whereNull('delivered_at')->orderBy('created_at')->paginate(50);
        $deliverers = User::whereRoleIs('superadministrator')->orWhereRoleIs('deliverer')->get();

        return view('list-requests')->with(['mask_requests'=>$requests,'deliverers'=>$deliverers]);
    }

    public function listByDeliverer(Request $request){
        $requests = MaskRequest::whereNull('delivered_at');

        if( $request->input('deliverer') != 0 )
            $requests = $requests->where('to_be_delivered_by_user_id',$request->input('deliverer'))->orderBy('created_at')->paginate(50);
        else
            $requests = $requests->whereNull('to_be_delivered_by_user_id')->orWhere('to_be_delivered_by_user_id',0)->orderBy('created_at')->paginate(50);
        $deliverers = User::whereRoleIs('superadministrator')->orWhereRoleIs('deliverer')->get();

        return view('list-requests')->with(['mask_requests'=>$requests,'deliverers'=>$deliverers]);
    }

    public function statistics(){

        $delivered_at = MaskRequest::orderBy('delivered_at','desc')->select('delivered_at')->first()->delivered_at;
        if( $delivered_at != NULL )
            $delivered_at=$delivered_at->diffForHumans();
    	$arr = [
    		'requests_delivered' => MaskRequest::whereNotNull('delivered_at')->count(),
    		/*
    		'last_delivery' => MaskRequest::latest('delivered_at')->delivered_at,
    		*/
    		'requests_to_be_delivered' => MaskRequest::whereNull('delivered_at')->count(),
    		'last_request' => MaskRequest::orderBy('id','desc')->select('created_at')->first()->created_at->diffForHumans(),
    		'last_delivery' => $delivered_at,
    		'mask_requests' => MaskRequest::inRandomOrder()->paginate(50),
    		'by_type' => MaskRequest::groupBy('reason')->selectRaw('sum(masks) as masks,sum(shields) as shields,reason')->get()
    	];

    	return view('requests-stats')->with($arr);	
    }

    public function assignWork(Request $request)
    {
        $arr = $request->all();
        $maskRequests = DB::table('maskrequest')->whereNull('delivered_at')->whereIn('id',$arr['work_to_be_assigned'])->update(['to_be_delivered_by_user_id'=>$arr['deliverer']]);
        return redirect()->to('list-requests');
    }

    public function markAsDelivered(Request $request){
        $arr = $request->all();
        $maskRequests = DB::table('maskrequest')->where('to_be_delivered_by_user_id',Auth::user()->id)->whereIn('id',$arr['work_to_be_assigned'])->update(['delivered_at'=>Carbon::now()]);
        return redirect()->to('list-requests');   
    }

}