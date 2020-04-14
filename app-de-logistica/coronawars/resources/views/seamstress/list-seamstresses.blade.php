@extends('layouts.app')

@section('head')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('List of seamstresses') }}</div>

                <div class="card-body">
                    <div class="btn-group" role="group" >
                      <a href="{{route('get-seamstress')}}" type="button" class="btn btn-primary">{{__('Create new seamstresser')}}</a>
                    </div>
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
                    {{ $seamstresses->links() }}
                    </div>

                    <table class="table table-striped table-hover" id="list">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col">{{__('Address')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($seamstresses as $seamstress)
                          <tr>
                              <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <a onclick="return confirm('{{__('Are you sure?')}}');" href="{{route('delete-seamstress',['id'=>$seamstress->id])}}" class="btn btn-danger" data-toggle="tooltip" title="{{__('Delete')}}"><i class="fa fa-trash"></i></a>
                                  <a href="{{route('get-seamstress',['seamstress_id'=>$seamstress->id])}}" data-toggle="tooltip" class="btn btn-light" title="{{__('Edit')}}"><i class="fa fa-pencil"></i></a>
                                </div>
                              </td>
                              <td>{{ $seamstress->name }}</td>
                              <td>{{ $seamstress->phone_number }}</td>
                              <td>{{ $seamstress->address }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>

                    <div class="d-print-none">
                    {{ $seamstresses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
