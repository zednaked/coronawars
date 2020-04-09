@extends('layouts.app')

@section('head')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
 
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/i18n/defaults-pt_BR.min.js"></script>

<script>
var timeoutId;
  $(document).ready(function(){
    $('#pre-selection').selectpicker();
    $('#pre-selection').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      $('#name').val($(e.currentTarget.options[clickedIndex]).data('name'));
      $('#address').val($(e.currentTarget.options[clickedIndex]).data('address'));
      $('#email').val($(e.currentTarget.options[clickedIndex]).data('email'));
      $('#phone_number').val($(e.currentTarget.options[clickedIndex]).data('phone_number'));
    });

    $("#search").keyup(function(){
        if( $("#search").val().length < 3 ) return;

        clearTimeout(timeoutId);
        $('#pre-selection').empty();
        $('#pre-selection').append($('<option>').text('{{__('Searching')}}'));
        $('#pre-selection').selectpicker('refresh');
        $('#pre-selection').selectpicker('render');
        timeoutId = setTimeout(function(){
          axios.get('{{route('api-get-companies')}}?q='+$('#search').val()).then(response => {
              $('#pre-selection').empty();
              $('#pre-selection').selectpicker('refresh');
              $('#pre-selection').selectpicker('render');

              for( i = 0; i < response.data.length; i++ ){
                var element = response.data[i];
                //data-tokens="ketchup mustard"
                $('#pre-selection').append($('<option data-email="'+element.email+'" data-name="'+element.name+'" data-phone_number="'+element.phone_number+'" data-address="'+element.address+'" data-subtext="'+element.email+'">').val(i).text(element.name+' - '+element.phone_number+' - '+element.address));
              }
              $('#pre-selection').selectpicker('refresh');
              $('#pre-selection').selectpicker('render');
          
          });}, 300);
    });
    
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

                          <div class="form-group">
                              <label class="control-label" for="search">{{ __('Search for existing address and find it below') }}</label>  

                              <div class="">
                                  <input id="search" name="search" type="text" placeholder="{{ __('Search for name, phone or email') }}" class="form-control input-md">
                              </div>
                              <br/>

                              <div class="">
                                <select id="pre-selection" class="selectpicker show-tick" data-live-search="true" data-width="100%" data-size="5" title="{{__('Refine below')}}">
                                </select>
                              </div>
                          </div>

                        </fieldset>

                        <fieldset>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label" for="address">{{ __('Address') }}</label>  
                                <div class="">
                                    <input id="address" name="address" type="text" placeholder="{{ __('rua Bill Gates, 1000 ap 800') }}" class="form-control input-md" required onblur="geocodeAddress()">
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
                                        <input id="name" name="name" type="text" class="form-control input-md" required value="{{Auth::user()->name}}">
                                    </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div>
                                    <label class="control-label" for="phone_number">{{ __('Phone') }}</label>  
                                    <div class="">
                                        <input id="phone_number" name="phone_number" type="text" class="form-control input-md" required value="{{Auth::user()->phone_number}}">
                                    </div>
                                </div>
                              </div>
                              
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-lg-12">
                                  <div>
                                      <label class="control-label" for="email">{{ __('E-mail') }}</label>  
                                      <div class="">
                                          <input id="email" name="email" type="text" class="form-control input-md" required value="{{Auth::user()->email}}">
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <br/>

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
