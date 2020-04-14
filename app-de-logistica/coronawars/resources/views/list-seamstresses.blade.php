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

                    <div class="d-print-none">
                    <input type="hidden" id="deliverer" name="deliverer" value=""/>
                    <br/><br/>
                    </div>

                    <table class="table table-striped table-hover" id="list">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col">{{__('Address')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($seamstresses as $seamstress)
                          <tr id="table_row_{{$seamstress->id}}" style="cursor:pointer" onclick="document.location='{{route('get-seamstress',['seamstress_id'=>$seamstress->id])}}'">
                              <td><a onclick="return confirm('{{__('Are you sure?')}}');" href="{{route('delete-seamstress',['id'=>$seamstress->id])}}" class="btn btn-danger" title="{{__('Delete')}}"><i class="fa fa-trash"></i></button></td>
                              <td>{{ $seamstress->name }}</td>
                              <td>{{ $seamstress->phone_number }}</td>
                              <td>{{ $seamstress->address }}</td>
                              <td>{{ $seamstress->email }}</td>
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
