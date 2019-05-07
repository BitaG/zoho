@extends('layout')
@section('title'){{trans('pages.Export')}}@endsection
@section('description'){{trans('pages.Export description')}}@endsection
@section('content')
    <section class="container client-list">
        <div class="row justify-content-center">
            @if($countClient==0)
                <div class="alert alert-info" id="alert">
                    Нет контактов для экспорта. Пожалуйста обновите контакты с InSales
                </div>
            @endif
                <div class="col-lg-8 py-3 px-0 ">

                    <a href="#" id="update" class="primary-link col-lg-8 p-0" @if($countClient==0) style="display: none;"@endif><img class="btn-ico" src="{{asset('images/update.svg')}}">Обновить контакты с InSales</a>
                </div>
                <ul id="userGroups" class="list-group panel-group col-lg-8 p-0"></ul>
                    <div class="col-lg-8 px-0 py-2 text-left d-flex justify-content-between align-items-center">
                        <span id="countClients" class="text-muted"></span>
                        <nav aria-label="pagination">
                            <ul id="page" class="pagination justify-content-end  fadeIn wow"></ul>
                        </nav>
                    </div>
        </div>
    </section>
    <div class="modal fade" id="exportModalCenter" tabindex="-1" role="dialog" aria-labelledby="exportModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('pages.Export')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="exportForm">
                        <div class="form-group">
                            <label for="exportBookSelect">{{trans('pages.Book list')}}</label>
                            <select class="form-control" id="exportBookSelect">
                                @foreach($bookList as $book)
                                <option value="{{$book->id}}">{{$book->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-check pt-2">
                            <input type="checkbox" id="exportSubscribeSelect" class="form-check-input">
                            <label class="form-check-label" for="exportSubscribeSelect">{{trans('pages.Export subscribers only')}}</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">{{trans('pages.Cancel')}}</button>
                    <button id="exportBtn" class="btn btn-green" data-dismiss="modal">{{trans('pages.Export start')}}</button>
                </div>
            </div>
        </div>
    </div>

    <section class="container-fluid btn-block ">
        @if($countClient==0)
            <button id="update-btn" class="btn btn-lg btn-green">Обновить контакты с InSales</button>
        @endif
            <button id="export-btn" class="btn btn-lg btn-green" data-toggle="modal" data-target="#exportModalCenter"  @if($countClient==0) style="display: none;"@endif>{{trans('pages.Do export')}}</button>
    </section>
    @component('component.message') @endcomponent
@endsection