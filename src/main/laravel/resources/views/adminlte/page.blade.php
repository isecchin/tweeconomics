@extends('adminlte.master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'sidebar-mini')

@section('body')
    <div class="wrapper">
        {{-- Main Header --}}
        @include('adminlte.partials.navbar')

        {{-- Left side column. contains the logo and sidebar --}}
        @include('adminlte.partials.sidebar')

        {{-- Content Wrapper. Contains page content --}}
        <div class="content-wrapper flex-column">
            {{-- Content Header (Page header) --}}
            <section class="content-header">
                @yield('content_header')
            </section>

            {{-- Main content --}}
            <section class="content">
                @yield('content')
            </section>
        </div>

        {{-- Footer --}}
        @include('adminlte.partials.footer')
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
