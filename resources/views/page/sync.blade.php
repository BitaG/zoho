@extends('layout')
@section('title'){{trans('pages.Sync')}}@endsection
@section('description'){{trans('pages.Sync description')}}@endsection
@section('content')
<div class="container pb-5">
    <div class="row justify-content-center">
      <div class="col-md-8 pt-md-4 p-2">
          <form class="panel p-md-5 p-4" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="col-12 text-center pb-3">
                  <h5 class="pb-3">{{trans('pages.Automatic export')}}</h5>
                  <small id="emailHelp" class="form-text text-muted">{{trans('pages.This feature allows you to automatically unload customers when creating an order')}}</small>
              </div>
              <div class="form-group">
                  <label for="auto_upload_book_id">{{trans('pages.Book list')}}</label>
                  <select class="form-control" id="auto_upload_book_id" name="auto_upload_book_id">
                      @foreach($bookList as $book)
                          <option value="{{$book->id}}" @if($book->id == $param->auto_upload_book_id) selected @endif>{{$book->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group form-check pt-2">
                  <input type="checkbox" class="form-check-input" id="auto_upload_order_client" name="auto_upload_order_client" @if($param->auto_upload_order_client == 'Y') checked @endif>
                  <label class="form-check-label" for="auto_upload_order_client">{{trans('pages.Use automatic export')}}</label>
              </div>
              <div class="col-12 text-right">
                  <button type="submit" class="btn btn-green">{{trans('pages.Save')}}</button>
              </div>
          </form>
      </div>
    </div>
</div>

@endsection