@extends('layouts.app')

@section('head')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of requests') }}</div>
                <div class="card-body">
                    <div class="btn-group d-print-none" role="group" >
                      <a href="{{route('get-supply-request')}}" type="button" class="btn btn-primary">{{__('Request supply')}}</a>
                      <a href="{{route('list-supply-request')}}?toBeDelivered=true" type="button" class="btn btn-info">{{__('To be delivered')}}</a>
                      <a href="{{route('list-supply-request')}}?pendingConciliation=true" type="button" class="btn btn-info mr-2">{{__('Pending conciliation')}}</a>
                      <a href="{{route('list-supply-request')}}?onlyArchived=true" type="button" class="btn btn-light">{{__('Only archived')}}</a>
                      <a href="{{route('list-supply-request')}}?all=true" type="button" class="btn btn-light">{{__('All')}}</a>
                    </div>
                    <br/>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-print-none">
                      <input type="hidden" id="deliverer" name="deliverer" value=""/>
                      <br/><br/>
                    </div>

                    <div class="d-print-none">
                    {{ $requests->links() }}
                    </div>
                    
                    <table class="table table-striped table-hover" id="list">
                        <thead>
                          <tr>
                            <th class="d-print-none"></th>
                            <th class="d-print-none">{{__('Delivered at')}}</th>
                            <th>{{__('To receive')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Masks')}}</th>
                            <th>{{__('Thread')}}</th>
                            <th>{{__('Elastic')}}</th>
                            <th>{{__('Other')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($requests as $request)
                          <tr @if(isset($highlight) && $request->id == $highlight) class="bg-danger" @endif>
                              <td class="align-middle d-print-none">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  @if($request->conciliations()->sum('masks_received') != $request->masks_cut)
                                  <a href="{{route('get-supply-request',['id'=>$request->id])}}" class="btn btn-light" data-toggle="tooltip" title="{{__('Edit')}}"><i class="fa fa-pencil"></i></a>
                                  <a onclick="return confirm('{{__('Are you sure?')}}');" data-toggle="tooltip" href="{{route('delete-supply-request',['id'=>$request->id])}}" class="btn btn-danger" title="{{__('Delete')}}"><i class="fa fa-trash"></i></a>
                                  @if($request->delivered_at==NULL)
                                  <a onclick="return confirm('{{__('Are you sure?')}}');" href="{{route('supply-request-mark-as-delivered',['id'=>$request->id])}}" class="btn btn-default" data-toggle="tooltip" title="{{__('Mark as delivered')}}"><i class="fa fa-truck"></i></a>
                                  @elseif($request->conciliations()->sum('masks_received') != $request->masks_cut)
                                  <a href="{{route('supply-request-conciliate',['id'=>$request->id])}}/" onclick="aux = prompt('{{__('How many masks were received?')}}'); if( aux == null || aux == 0 ) return false; this.href = this.href+aux" class="btn btn-light" data-toggle="tooltip" title="{{__('Conciliar suprimento com entrega da costureira')}}"><i class="fa fa-handshake-o"></i></a>
                                  @endif
                                  @else
                                  @if( $request->archived_at != NULL)
                                  <a onclick="return confirm('{{__('Are you sure?')}}');"  href="{{route('supply-request-activate',['id'=>$request->id,'activate'=>true])}}" class="btn btn-light" data-toggle="tooltip" title="{{__('Activate')}}"><i class="fa fa-undo"></i></a>
                                  @else
                                  <a onclick="return confirm('{{__('Are you sure?')}}');"  href="{{route('supply-request-archive',['id'=>$request->id])}}/" class="btn btn-light" data-toggle="tooltip" title="{{__('Archive')}}"><i class="fa fa-archive"></i></a>
                                  @endif
                                  @endif
                                </div>
                              </td>
                              <td class="align-middle d-print-none">{{ $request->delivered_at == NULL ? __('Never') : $request->delivered_at->diffForHumans() }}</td>
                              <td class="align-middle">{{ $request->masks_cut - $request->conciliations()->sum('masks_received') }}</td>
                              <td class="align-middle">{{ $request->seamstress->name }}</td>
                              <td class="align-middle">{{ $request->seamstress->phone_number }}</td>
                              <td class="align-middle">{{ $request->seamstress->address }}</td>
                              <td class="align-middle">{{ $request->masks_cut }}</td>
                              <td class="align-middle">{{ $request->thread }}</td>
                              <td class="align-middle">{{ $request->elastic }}</td>
                              <td class="align-middle d-print-none"><i class="fa fa-info-circle fa-3x" title="{{ $request->other }}" data-toggle="tooltip"></i></td>
                              <td class="align-middle d-none d-print-table-cell">{{ $request->other }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>

                    <div class="d-print-none">
                    {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
