@extends('layouts.app')

@section('head')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
 
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/i18n/defaults-pt_BR.min.js"></script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&callback=initMap">
</script>
<script>
var geocoder;
var isValidForm = false;
  function initMap(){
    geocoder = new google.maps.Geocoder();
  }
  function geocodeAddress() {
        var address = $('#address').val();
        address += $('#city_country').val();
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            $('#geo_lon').val(results[0].geometry.location.lng()); 
            $('#geo_lat').val(results[0].geometry.location.lat());
            $('.alert.alert-danger').empty(); 
            isValidForm = true;
          } else {
            $('.alert.alert-danger').html('{{__('Location not found.')}}');
            $('#geo_lon').val(''); 
            $('#geo_lat').val(''); 
            @if( env('APP_DEBUG') ) 
            console.log('Geocode was not successful for the following reason: ' + status);
            @endif
          }
        });
      }
</script>
<style>
  .alert.alert-danger:empty{
    display:none;
  }
  .alert.alert-danger:not(:empty){
    display:block;
  }
  </style>

@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Seamstress') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="alert alert-danger" role="alert"></div>
                    
                    <form class="form-horizontal" method="POST" action="{{ $seamstress != NULL && $seamstress->id >=1 ? route('post-seamstresses',['id'=>$seamstress->id]) : route('post-seamstresses') }}" onsubmit="if( !isValidForm ) { $('.alert.alert-danger').html('{{__('Invalid form.')}}');
            return false; } return true;">
                        @csrf
                        <fieldset>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="address">{{ __('Address') }}</label>  
                                <div class="">
                                    <input id="address" name="address" type="text" value="{{ $seamstress->address }}" class="form-control input-md" required onblur="geocodeAddress()">
                                    <input id="geo_lon" name="geo_lon" type="hidden" value="" class="form-control input-md">
                                    <input id="geo_lat" name="geo_lat" type="hidden" value="" class="form-control input-md">
                                </div>
                              </div>
                            </div>
                            <br/>
                            <div class="row">
                              <div class="col-lg-6">
                                <div>
                                    <label class="control-label" for="name">{{ __('Name') }}</label>  
                                    <div class="">
                                        <input id="name" name="name" type="text" class="form-control input-md" required value="{{$seamstress->name}}">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div>
                                    <label class="control-label" for="phone_number">{{ __('Phone') }}</label>  
                                    <div class="">
                                        <input id="phone_number" name="phone_number" type="text" class="form-control input-md" required value="{{$seamstress->phone_number}}">
                                    </div>
                                </div>
                              </div>
                              
                            </div>
                            <br/>
                        </fieldset>

                         <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Create/update') }}</button>
                        </div>
                       
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
