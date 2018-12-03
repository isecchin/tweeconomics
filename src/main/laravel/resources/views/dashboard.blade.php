@extends('adminlte.page')

@section('title', 'Tweeconomics - Dashboard')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ trans('adminlte.dashboard') }} - {{ $company->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">{{ trans('adminlte.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('adminlte.dashboard') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <input type="hidden" name="company" data-nasdaq="{{ $company->nasdaq }}" value="{{ $company->getKey() }}">

        <div class="row">
            @foreach($sentiments as $sentiment)
                <div class="col-4">
                    <div class="small-box {{ $sentiment->panel_class }}">
                        <div class="inner">
                            <h3 id="total-{{ str_slug($sentiment->label, '-') }}">
                                <i class="fas fa-spinner fa-spin"></i>
                            </h3>
                            <p>{{ trans('sentiment.' . str_slug($sentiment->label, '_')) }}</p>
                        </div>

                        <div class="icon">
                            <i class="{{ $sentiment->icon }}"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="data-since" style="width: 100%;text-align: right;padding-right: 10px;">
                <span class="data-since-title">{{ trans('dashboard.data_since_title') }}</span>
                <span class="data-since-value">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="card" style="width: 100%;margin: 10px;">
                <div class="card-header d-flex p-0 ui-sortable-handle">
                    <h3 class="card-title p-3">
                        <i class="fas fa-chart-line mr-1"></i>
                        {{ trans('dashboard.tweets_chart_title') }}
                    </h3>

                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item">
                            <a class="nav-link graph-daily active" href="#">{{ trans('dashboard.daily') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link graph-weekly" href="#">{{ trans('dashboard.weekly') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link graph-monthly" href="#">{{ trans('dashboard.monthly') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link graph-yearly" href="#">{{ trans('dashboard.yearly') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div id="chart-div">
                        <i class="fas fa-spinner fa-spin fa-5x chart-loading"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card" style="width: 100%;margin: 10px;">
                <div class="card-header d-flex p-0 ui-sortable-handle">
                    <h3 class="card-title p-3">
                        <i class="fas fa-chart-line mr-1"></i>
                        {{ trans('dashboard.stocks_chart_title', ['nasdaq' => $company->nasdaq]) }}
                    </h3>
                </div>

                <div class="card-body">
                    <div id="stocks-chart-div">
                        <i class="fas fa-spinner fa-spin fa-5x chart-loading"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        var stocks = new Stocks('{{ config('stocks.api_key') }}');
    </script>
@stop
