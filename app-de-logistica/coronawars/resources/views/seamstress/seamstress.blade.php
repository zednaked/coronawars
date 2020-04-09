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
          } else {
            $('#geo_lon').val(''); 
            $('#geo_lat').val(''); 
            @if( env('APP_DEBUG') ) 
            console.log('Geocode was not successful for the following reason: ' + status);
            @endif
          }
        });
      }
</script>

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

                    <form class="form-horizontal" method="POST" action="{{ $seamstress != NULL && $seamstress->id >=1 ? route('post-seamstresses',['id'=>$seamstress->id]) : route('post-seamstresses') }}">
                        @csrf
                        <fieldset>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label" for="address">{{ __('Address') }}</label>  
                                <div class="">
                                    <input id="address" name="address" type="text" value="{{ $seamstress->address }}" class="form-control input-md" required onblur="geocodeAddress()">
                                    <input id="geo_lon" name="geo_lon" type="hidden" value="" class="form-control input-md">
                                    <input id="geo_lat" name="geo_lat" type="hidden" value="" class="form-control input-md">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                  <label class="control-label" for="city_country">{{ __('City and country') }}</label>  
                                  <div class="">
                                      <input id="city_country" name="city_country" type="text" readonly class="form-control input-md" required value="Curitiba, Brasil">
                                      {{ __('* Only Curitiba for now.') }}
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
