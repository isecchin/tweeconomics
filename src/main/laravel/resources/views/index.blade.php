@extends('adminlte.page')

@section('title', 'QualityAir')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ trans('adminlte.home') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">
                        {{ trans('adminlte.home') }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="home-text">
        <span>{{ trans('home.welcome') }}</span>
        <span>{{ trans('home.description') }}</span>
        <span>{{ trans('home.expectation') }}</span>
        <span>{{ trans('home.disclaimer') }}</span>
        <br>
        <span><b>{{ trans('home.instructions') }}</b></span>
    </div>
@stop
