@extends('layout')
@section('title') {{trans('pages.Web push service')}} @endsection
@section('description') {{trans('pages.Web push description')}} @endsection
@section('content')
<div class="container pb-5">
    <div class="row justify-content-center">
      <div class="col-md-8 pt-md-4 p-2">
          @if(!empty($alert))
              <div class="alert alert-primary text-center" id="alert">
                  {{$alert}}
              </div>
          @else
          <form class="panel p-md-5 p-4" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-12 text-center pb-3">
                  <h5 class="pb-3">{{trans('pages.Web push service connect')}}</h5>
                  <small id="emailHelp" class="form-text text-muted">{{trans('pages.You can find out more information about the push service')}} <a href="https://login.sendpulse.com/push/" class="primary-link"> https://login.sendpulse.com/push/</a></small>
              </div>
              <div class="form-group form-check py-4">
                  <input type="checkbox" class="form-check-input" id="pushInit" name="pushInit" @if($param->push_service == 'Y') checked @endif>
                  <label class="form-check-label" for="pushInit">{{trans('pages.Connect web push service to the store')}}</label>
              </div>
              <div class="col-12 text-right">
                  <button type="submit" class="btn btn-green">{{trans('pages.Save')}}</button>
              </div>
          </form>
          @endif
      </div>
    </div>
</div>

@endsection