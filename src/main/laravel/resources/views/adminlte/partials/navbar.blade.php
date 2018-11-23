<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link push-menu" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">{{ trans('adminlte.home') }}</a>
        </li>
    </ul>

    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <select class="select2 form-control form-control-navbar company-picker" type="search" placeholder="{{ trans('adminlte.search') }}" aria-label="{{ trans('adminlte.search') }}">

                @foreach ($companies as $company)
                    @if ($loop->first)
                        <option></option>
                    @endif
                    <option value="{{ route('dashboard', $company->getKey()) }}">
                        {{ $company->name }}
                    </option>
                @endforeach

            </select>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</nav>
