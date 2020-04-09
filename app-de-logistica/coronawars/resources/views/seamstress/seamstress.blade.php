@extends('layouts.app')

@section('head')

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
 
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/i18n/defaults-pt_BR.min.js"></script>

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
                                    <input id="address" name="address" type="text" value="{{ $seamstress->address }}" class="form-control input-md" required>
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
                            <div class="row">
                                <div class="col-lg-12">
                                  <div>
                                      <label class="control-label" for="email">{{ __('E-mail') }}</label>  
                                      <div class="">
                                          <input id="email" name="email" type="text" class="form-control input-md" required value="{{$seamstress->email}}">
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
