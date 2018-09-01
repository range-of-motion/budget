<!DOCTYPE html>
<html>
    <head>
        @if (View::hasSection('title')) <title>@yield('title') - {{ config('app.name') }}</title> @else <title>{{ config('app.name') }}</title> @endif
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="/storage/fontawesome/all.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,400i,600,600i" />
        <link rel="stylesheet" href="/css/app.css" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" />
        <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <style>
            .ct-series-a .ct-slice-donut-solid {
                fill: #3474EE;
            }

            .ct-series-b .ct-slice-donut-solid {
                fill: #E73428;
            }

            .ct-series-c .ct-slice-donut-solid {
                fill: #F5AE29;
            }

            .ct-series-d .ct-slice-donut-solid {
                fill: #299944;
            }
        </style>
    </head>
    <body>
        <div id="app">
            @if (Auth::check())
                <div class="navigation">
                    <div class="wrapper">
                        <ul class="navigation__menu">
                            <li>
                                <a href="/dashboard" {!! (Request::path() == 'dashboard') ? 'class="active"' : '' !!}><i class="fas fa-home fa-sm mr-05"></i> @lang('general.dashboard')</a>
                            </li>
                        </ul>
                        <ul class="navigation__menu">
                            <li class="dropdown">
                                <a href="#" class="dropdown__toggle">
                                    <i class="far fa-plus mr-05"></i> <i class="fas fa-caret-down fa-sm"></i>
                                </a>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/earnings/create">New earning</a>
                                    </li>
                                    <li>
                                        <a href="/spendings/create">New spending</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown__toggle">
                                    <img src="{{ Auth::user()->avatar ? '/storage/avatars/' . Auth::user()->avatar : 'http://placehold.it/50x50' }}" class="avatar mr-05" /> <i class="fas fa-caret-down fa-sm"></i>
                                </a>
                                <ul class="dropdown__list">
                                    <li>
                                        <a href="/settings">Settings</a>
                                    </li>
                                    <li>
                                        <a href="/logout">Log out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            @yield('body')
        </div>
        <script src="/js/app.js"></script>
        @yield('scripts')
        <script>
            var dropdowns = document.querySelectorAll('.dropdown__toggle');

            for (var i = 0; i < dropdowns.length; i ++) {
                var a = dropdowns[i];

                trigger(a);
            }

            function trigger(el) {
                el.addEventListener('click', function (e) {
                    e.preventDefault();

                    closeAll(el);

                    var parent = e.target.parentNode;

                    if (parent.nodeName != 'LI') {
                        parent = parent.parentNode;
                    }

                    var x = parent.querySelector('.dropdown__list');

                    if (x.style.display == 'flex') {
                        x.style.display = 'none';
                    } else {
                        x.style.display = 'flex';
                    }
                });
            }

            function closeAll(skip) {
                for (var i = 0; i < dropdowns.length; i ++) {
                    if (dropdowns[i] != skip) {
                        dropdowns[i].parentNode.querySelector('.dropdown__list').style.display = 'none';
                    }
                }
            }
        </script>
    </body>
</html>
