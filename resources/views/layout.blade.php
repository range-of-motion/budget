<!DOCTYPE html>
<html>
    <head>
        <title>{{ View::hasSection('title') ? View::getSection('title') . ' - ' . config('app.name') : config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="/storage/fontawesome/all.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,400i,600,600i" />
        <link rel="stylesheet" href="/css/app.css" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" />
        <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <style>
            .ct-series-a .ct-slice-donut-solid {
                fill: #179BD1;
            }

            .ct-series-b .ct-slice-donut-solid {
                fill: #E4E8EB;
            }

            .ct-series-a .ct-line {
                stroke-width: 2px;
                stroke: #179BD1;
            }

            .theme-dark .ct-label {
                color: #758193;
            }

            [v-cloak] {
                display: none;
            }
        </style>
    </head>
    <body class="theme-{{ Auth::check() ? Auth::user()->theme : 'light' }}">
        <div id="app">
            @if (Auth::check())
                <div class="navigation">
                    <div class="wrapper">
                        <ul class="navigation__menu">
                            <li>
                                <a href="/dashboard" {!! (Request::path() == 'dashboard') ? 'class="active"' : '' !!}><i class="far fa-home fa-sm color-blue"></i> <span class="hidden ml-05">{{ __('general.dashboard') }}</span></a>
                            </li>
                            <li>
                                <a href="/recurrings" {!! (Request::path() == 'recurrings') ? 'class="active"' : '' !!}><i class="far fa-recycle fa-sm color-green"></i> <span class="hidden ml-05">{{ __('models.recurrings') }}</span></a>
                            </li>
                            <li>
                                <a href="/tags" {!! (Request::path() == 'tags') ? 'class="active"' : '' !!}><i class="far fa-tag fa-sm color-red"></i> <span class="hidden ml-05">{{ __('models.tags') }}</span></a>
                            </li>
                            <li>
                                <a href="/reports" {!! (Request::path() == 'reports') ? 'class="active"' : '' !!}><i class="far fa-chart-line fa-sm color-blue"></i> <span class="hidden ml-05">Reports</span></a>
                            </li>
                        </ul>
                        <ul class="navigation__menu">
                            <li>
                                <dropdown>
                                    <span slot="button">
                                        <i class="far fa-plus mr-05"></i> <i class="fas fa-caret-down fa-sm"></i>
                                    </span>
                                    <ul slot="menu" v-cloak>
                                        <li>
                                            <a href="/earnings/create">{{ __('actions.create') }} {{ __('models.earning') }}</a>
                                        </li>
                                        <li>
                                            <a href="/spendings/create">{{ __('actions.create') }} {{ __('models.spending') }}</a>
                                        </li>
                                    </ul>
                                </dropdown>
                            </li>
                            @if (Auth::user()->spaces->count() > 1)
                                <li>
                                    <dropdown>
                                        <span slot="button">
                                            {{ str_limit(session('space')->name, 3) }} <i class="fas fa-caret-down fa-sm"></i>
                                        </span>
                                        <ul slot="menu" v-cloak>
                                            @foreach (Auth::user()->spaces as $space)
                                                <li>
                                                    <a href="/spaces/{{ $space->id }}">{{ $space->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dropdown>
                                </li>
                            @endif
                            <li>
                                <dropdown>
                                    <span slot="button">
                                        <img src="{{ Auth::user()->avatar }}" class="avatar mr-05" /> <i class="fas fa-caret-down fa-sm"></i>
                                    </span>
                                    <ul slot="menu" v-cloak>
                                        <li>
                                            <a href="/imports">{{ __('models.imports') }}</a>
                                        </li>
                                        <li>
                                            <a href="/settings">{{ __('pages.settings') }}</a>
                                        </li>
                                        <li>
                                            <a href="/logout">{{ __('pages.log_out') }}</a>
                                        </li>
                                    </ul>
                                </dropdown>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            @yield('body')
            @if (auth()->check())
                <div class="text-center mb-3">
                    <a href="/ideas/create" style="font-size: 14px;">Know how to make this app better?</a>
                </div>
            @endif
        </div>
        <script src="/js/app.js"></script>
        @yield('scripts')
    </body>
</html>
