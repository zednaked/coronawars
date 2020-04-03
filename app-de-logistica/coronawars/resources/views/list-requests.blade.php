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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{route('assign-work')}}" >
                      @csrf
                    <div class="d-print-none btn-group" role="group" aria-label="Button group with nested dropdown">
                      <div class="btn-group mr-2" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{__('Assign deliverer')}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item" href="#" onclick="$('#deliverer').val(0);$('form').submit()">{{__('None')}}</a>@foreach($deliverers as $deliverer)
                          <a class="dropdown-item" href="#" onclick="$('#deliverer').val({{$deliverer->id}});$('form').submit()">{{$deliverer->id}} - {{$deliverer->name}}</a>
                          @endforeach
                        </div>
                      </div>
                      <div class="btn-group mr-2" role="group">
                          <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Route::currentRouteName()=="list-requests-by-deliverer")
                            {{__('Showing only deliverer ')}}: {{Request::input('deliverer')}}
                            @else
                            {{__('Filter by deliverer')}}
                            @endif
                          </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{route('list-requests')}}">{{__('Clear filter')}}</a>
                            <a class="dropdown-item" href="{{route('list-requests-by-deliverer',['deliverer'=>0])}}">0 - {{__('None')}}</a>
                            @foreach($deliverers as $deliverer)
                            <a class="dropdown-item" href="{{route('list-requests-by-deliverer',['deliverer'=>$deliverer->id])}}">{{$deliverer->id}} - {{$deliverer->name}}</a>
                            @endforeach
                          </div>                            
                      </div>            
                      @if(Auth::user()->hasRole('superadministrator') || Auth::user()->id == Request::input('deliverer') )        
                      <a href="#" onclick="$('form').attr('action','{{route('mark-as-delivered')}}');$('form').submit()" type="button" class="btn btn-secondary mr-2" aria-haspopup="true" aria-expanded="false">{{__('Mark as delivered')}}</a>
                      @endif
                    </div>

                    <div class="d-print-none">
                    <input type="hidden" id="deliverer" name="deliverer" value=""/>
                    <br/><br/>
                    </div>

                    <table class="table table-striped table-hover" id="list">
                        <thead>
                          <tr>
                            <th class="d-print-none"></th>
                            @if(Route::currentRouteName()!="list-requests-by-deliverer")
                              <th scope="col">{{__('To be delivered by')}}</th>
                            @else
                              <th scope="col">{{__('Name')}}</th>
                              <th scope="col">{{__('Phone')}}</th>
                            @endif
                            <th scope="col">{{__('Address')}}</th>
                            <th scope="col">{{__('Reason')}}</th>
                            <th scope="col">{{__('Masks quantity')}}</th>
                            <th scope="col">{{__('Shields quantity')}}</th>
                            <th scope="col" class="d-print-none" >{{__('Requested at')}}</th>
                            <th scope="col" class="d-none d-print-table-cell">{{__('Requested at')}}</th>
                            <th scope="col" class="d-none d-print-table-cell">{{ __('Date/Signature') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($mask_requests as $mask_request)
                          <tr id="table_row_{{$mask_request->id}}" style="cursor:pointer" onclick="$('#row_{{$mask_request->id}}').prop('checked',!$('#row_{{$mask_request->id}}').prop('checked'));">
                              <td class="d-print-none" style="width:40px"><input id="row_{{$mask_request->id}}" name="work_to_be_assigned[]" type="checkbox" value="{{$mask_request->id}}"></td>
                              @if(Route::currentRouteName()!="list-requests-by-deliverer")
                                <td>{{ $mask_request->to_be_delivered_by_user_id }}</td>
                              @else
                                <td>{{ $mask_request->name }}</td>
                                <td>{{ $mask_request->phone_number }}</td>
                              @endif
                              <td>{{ $mask_request->address }}</td>
                              <td>{{ __($mask_request->reason) }}</td>
                              <td>{{ $mask_request->masks }}</td>
                              <td>{{ $mask_request->shields }}</td>
                              <td class="d-print-none" style="width:10%" data-toggle="tooltip" title="{{ $mask_request->created_at}}">{{ $mask_request->created_at->diffForHumans() }}</td>
                              <td class="d-none d-print-table-cell">{{ $mask_request->created_at }}</td>
                              <td class="d-none d-print-table-cell"></td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    </form>

                    <div class="d-print-none">
                    {{ $mask_requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
