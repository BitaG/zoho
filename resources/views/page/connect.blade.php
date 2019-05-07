@extends('layout')
@section('title') {{trans('pages.Connect')}}@endsection
@section('description') {{trans('pages.Connect description')}}@endsection
@section('content')
<div class="container pb-5">
    <div class="row justify-content-center">
      <div class="col-md-8 pt-md-4 p-2">
          <form class="panel p-md-5 p-4" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-12 text-center pb-3">
                  <h5 class="pb-3">{{trans('pages.SendPulse REST API authorization details')}}</h5>
                  <small id="emailHelp" class="form-text text-muted">{{trans('pages.Authorization data can be found on the page')}} <a  class="primary-link" href="https://login.sendpulse.com/settings/#api"> https://login.sendpulse.com/settings/#api</a></small>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Secret ID</label>
                  <input type="text" name="clientId" class="form-control" value="{{$params->client_id}}">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Secret KEY</label>
                  <input type="text" name="clientSecret" class="form-control" value="{{$params->client_secret}}">
              </div>
              <div class="col-12 text-right">
                  <button type="submit" class="btn btn-green">{{trans('pages.Do connect')}}</button>
              </div>
          </form>
      </div>
    </div>
</div>
@endsection