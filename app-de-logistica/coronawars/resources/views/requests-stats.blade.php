@extends('layouts.app')

@section('head')

@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-info text-center">
              <div class="card-header">
                {{__('Delivered masks')}}
              </div>
              <div class="card-body">
                <h1 class="card-title">{{$requests_delivered}}</h1>
              </div>
              <div class="card-footer text-muted">
                <p class="card-text">{{__('Last delivery')}}</p>
                {{$last_delivery}}
              </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-warning text-center">
              <div class="card-header">
                {{__('Requests pending')}}
              </div>
              <div class="card-body">
                <h1 class="card-title">{{$requests_to_be_delivered}}</h1>
              </div>
              <div class="card-footer text-muted">
                <p class="card-text">{{__('Last request')}}</p>
                {{$last_request}}
              </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        @foreach($by_type as $t)
        <div class="col-md-4">
            <div class="card bg-default text-center">
              <div class="card-header" style="max-height: 48px;overflow: hidden;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                {{__($t->reason)}}
              </div>
              <div class="card-body">
                <h1 class="card-title">{{__('Masks')}}: {{$t->masks}}</h1>
                <h1 class="card-title">{{__('Shields')}}: {{$t->shields}}</h1>
              </div>
            </div>
        </div>
        @endforeach
    </div>
    <br/>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">{{__('Reason')}}</th>
                <th scope="col">{{__('Masks quantity')}}</th>
                <th scope="col">{{__('Shields quantity')}}</th>
                <th scope="col">{{__('Delivered at')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($mask_requests as $mask_request)
              <tr>
                  <td>{{ __($mask_request->reason) }}</td>
                  <td>{{ $mask_request->masks }}</td>
                  <td>{{ $mask_request->shields }}</td>
                  <td>{{ $mask_request->delivered_at == null ? '' : $mask_request->delivered_at->diffForHumans() }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>

        {{ $mask_requests->links() }}
      </div>
    </div>
</div>
@endsection
