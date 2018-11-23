<footer class="main-footer">
    <strong>
        Copyright © {{ date('Y') }}
        <a href="{{ config('dev.site', '') }}" target="_blank">{{ config('dev.team', '') }}</a>.
    </strong>
    {{ trans('adminlte.all_rights_reserved') }}
    <div class="float-right d-none d-sm-inline-block">
        <b>{{ trans('adminlte.version')}}</b> {{ config('app.version', '') }}
    </div>
</footer>
