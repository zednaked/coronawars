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
                <div class="card-header">{{ __('Request supply') }}</div>

                <div class="card-body">
                    <br/><br/>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <br/>
                    
                    <form class="form-horizontal" method="POST" action="{{ $request != NULL && $request->id >=1 ? route('post-supply-request',['id'=>$request->id]) : route('post-supply-request') }}">
                        @csrf
                        <fieldset>
                          <div class="form-group">
                            <label class="control-label" for="search">{{ __('Search for seamstresser') }}</label>  

                            <div class="">
                              <select tabindex="1" required name="seamstresser_id" id="seamstresser_id" class="selectpicker show-tick" data-live-search="true" data-width="100%" data-size="5" title="{{__('Search for seamstresser')}}">
                                @foreach($seamstresses as $seamstress)
                                <option data-tokens="{{$seamstress->email}}" data-subtext="{{$seamstress->phone_number}}" value="{{$seamstress->id}}" {{$request->seamstress_id == $seamstress->id ? 'selected' : ''}}>{{$seamstress->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label" for="masks_cut">{{ __('Masks Quantity') }}</label>
                            <div class="">
                              <input tabindex="2" type="number" id="masks_cut" name="masks_cut" class="form-control" required value="{{$request->masks_cut}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label" for="thread">{{ __('Thread Quantity') }}</label>
                            <div class="">
                              <input tabindex="3" type="number" id="thread" name="thread" class="form-control" required value="{{$request->thread}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label" for="elastic">{{ __('Elastic Quantity') }}</label>
                            <div class="">
                              <input tabindex="4" type="number" id="elastic" name="elastic" class="form-control" required value="{{$request->elastic}}">
                            </div>
                          </div>


                          <div class="form-group">
                            <label class="control-label" for="other">{{ __('Further request') }}</label>
                            <div class="">
                              <textarea tabindex="5" id="other" name="other" class="w-100" rows="3" placeholder="{{ __('Further request') }}">{{$request->other}}</textarea>
                            </div>
                          </div>

                        </fieldset>

                         <div class="form-group">
                            <button tabindex="6" type="submit" class="btn btn-primary btn-lg">{{ __('Request') }}</button>
                        </div>
                       
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
