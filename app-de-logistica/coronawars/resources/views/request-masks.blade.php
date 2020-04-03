@extends('layouts.app')

@section('head')
<script>
$(document).ready(function(){
    $('form input:radio').click(function(){
        if( $('form input:checked').val() !== "personal" ){
            $('form .masks_quantity').empty().append($('.templates .masks_quantity.multiple-possibilities').clone());
            $('form .shields_quantity').empty().append($('.templates .shields_quantity.multiple-possibilities').clone());
        }
        else{
            $('form .masks_quantity').empty().append($('.templates .masks_quantity.fixed-possibilities').clone());
            $('form .shields_quantity').empty().append($('.templates .shields_quantity.no-shields').clone());
        }
    });  
});
</script>
@endsection

@section('content')
<div class="templates" style="display:none">
    <div class="fixed-possibilities masks_quantity">
      <label class="control-label" for="masks_quantity">{{ __('Masks Quantity') }}</label>
      <div class="">
        <select id="masks_quantity" name="masks" class="form-control" required>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
      </div>
    </div>

    <div class="shields_quantity no-shields"></div>

    <div class="multiple-possibilities masks_quantity">
      <label class="control-label" for="masks_quantity">{{ __('Masks Quantity') }}</label>
      <div class="">
        <input type="number" id="masks_quantity" name="masks" class="form-control" required>
      </div>
    </div>

    <div class="multiple-possibilities shields_quantity">
      <label class="control-label" for="shields_quantity">{{ __('Shields Quantity') }}</label>
      <div class="">
        <input type="number" id="shields_quantity" name="shields" class="form-control" required>
      </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Request masks') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('post-request-mask') }}">
                        @csrf
                        <fieldset>

                        <!-- Multiple Radios -->
                        <div class="form-group required">
                          <label class="control-label" for="reason">{{ __('Reason') }}</label>
                          <div class="">
                          <div class="radio">
                            <label for="reason-0">
                              <input type="radio" name="reason" id="reason-0" value="hospital">
                              {{ __('Hospital needs') }}
                            </label>
                            </div>
                          <div class="radio">
                            <label for="reason-1">
                              <input type="radio" name="reason" id="reason-1" value="personal">
                              {{ __('Personal needs') }}
                            </label>
                            </div>
                          <div class="radio">
                            <label for="reason-2">
                              <input type="radio" name="reason" id="reason-2" value="critical_business">
                              {{ __('Critical business needs (producing food, public transport,...)') }}
                            </label>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="masks_quantity"></div>
                            <div class="shields_quantity"></div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <div>
                                <label class="control-label" for="address">{{ __('Address') }}</label>  
                                <div class="">
                                    <input id="address" name="address" type="text" placeholder="{{ __('rua Bill Gates, 1000 ap 800') }}" class="form-control input-md" required>
                                <div>
                            <br/>
                            <div>
                                <label class="control-label" for="city_country">{{ __('City and country') }}</label>  
                                <div class="">
                                    {{ __('* Only Curitiba for now.') }}
                                    <input id="city_country" name="city_country" type="text" readonly class="form-control input-md" required value="Curitiba, Brasil">
                                </div>
                            </div>
                            <br/>
                                    {{ __('* From your user.') }}
                            <br/>
                            <div>
                                <label class="control-label" for="phone_number">{{ __('Phone') }}</label>  
                                <div class="">
                                    <input id="phone_number" name="phone_number" type="text" class="form-control input-md" required value="{{Auth::user()->phone_number}}">
                                </div>
                            </div>

                            <div>
                                <label class="control-label" for="name">{{ __('Name') }}</label>  
                                <div class="">
                                    <input id="name" name="name" type="text" class="form-control input-md" required value="{{Auth::user()->name}}">
                                </div>
                            </div>

                            <div>
                                <label class="control-label" for="email">{{ __('E-mail') }}</label>  
                                <div class="">
                                    <input id="email" name="email" type="text" class="form-control input-md" required value="{{Auth::user()->email}}">
                                </div>
                            </div>
                        </div>

                        </fieldset>

                         <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Request') }}</button>
                        </div>
                       
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
