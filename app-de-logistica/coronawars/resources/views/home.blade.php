@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{__('Make your own mask')}}</h5>
                <p class="card-text">{{__('Below you can find three molds for your masks, the kids and adult versions, and also molds similar to surgical masks. Print it and make your own mask')}}</p>
                <div class="btn-group">
                <a target="_blank" href="https://github.com/zednaked/coronawars/raw/master/molde%20mascara%20coronavirus%20KIDS.pdf" class="btn btn-primary">{{__('Kids version')}}</a>
                <a target="_blank" href="https://github.com/zednaked/coronawars/raw/master/molde%20mascara%20coronavirus.pdf" class="btn btn-primary">{{__('Adult version')}}</a>
                </div>
                <br/><br/>
                <div class="btn-group">
                    <a target="_blank" href="https://github.com/zednaked/coronawars/raw/master/molde%20mascara%20coronavirus%20-%20reta.pdf" class="btn btn-primary">{{__('Surgical version')}}</a>
                </div>
                                    
              </div>
            </div>
            <br/>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{__('Request masks')}}</h5>
                <p class="card-text">{{__('We deliver to you for free. It\'s urgent we save lives.')}}</p>   
                <a href="{{ route('request-masks') }}" class="btn btn-danger">{{__('Request masks')}}</a>                  
              </div>
            </div>
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
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ __('Show statistics') }}</h5>
                <p class="card-text">{{__('Transparency is important. Check the number of requests we already received.')}}</p>
                <a class="btn btn-success" href="{{ route('show-statistics') }}">{{ __('Show statistics') }}</a>
              </div>
            </div>
            <br/>
            @if(Auth::check())
            @if( Auth::user()->hasRole('superadministrator') || Auth::user()->hasRole('deliverer') )
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">{{ __('List requests') }}</h5>
                        <p class="card-text">{{__('If you are a deliverer or administrator, please, check here what are the orders we need to take.')}}</p>
                        <a class="btn btn-warning" href="{{ route('list-requests') }}">{{ __('List requests') }}</a>

                      </div>
                    </div>
                </div>
            </div> 
            @endif
            @endif
        </div>
    </div>
</div>
@endsection
