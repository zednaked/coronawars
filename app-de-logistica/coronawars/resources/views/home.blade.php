@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('request-masks') }}">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{__('Request masks')}}</h5>
                    <p class="card-text">{{__('We deliver to you for free. It\'s urgent we save lives.')}}</p>                    
                  </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="http://vaka.me/952315">
                <div class="card">
                  <div class="card-body @if(isset($callForAction) && $callForAction) bg-info @endif ">
                    <h5 class="card-title" style="@if(isset($callForAction) && $callForAction) animation: blinker 1s linear 5; @endif">{{ __('Contribute') }}</h5>
                    <p class="card-text">{{__('If you like what we are doing, we are accepting donations to continue to do so. Our time is for free, but we need money to buy supplies. Help us!')}}</p>
                    <center><img style="width:300px" src="https://static.vakinha.com.br/uploads/vakinha/image/952315/mascara-protecao-caseira.jpg?ims=700x410" /></center>
                  </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('show-statistics') }}">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('Show statistics') }}</h5>
                    <p class="card-text">{{__('Transparency is important. Check the number of requests we already received.')}}</p>
                  </div>
                </div>
            </a>
        </div>
    </div>
    <br/>
    @if(Auth::check())
    @if( Auth::user()->hasRole('superadministrator') || Auth::user()->hasRole('deliverer') )
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('list-requests') }}">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('List requests') }}</h5>
                    <p class="card-text">{{__('If you are a deliverer or administrator, please, check here what are the orders we need to take.')}}</p>
                  </div>
                </div>
            </a>
        </div>
    </div> 
    @endif
    @endif
</div>
@endsection
