<!DOCTYPE html>
<html>
    <head>
        <title>Budget</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,400i" />
        <link rel="stylesheet" href="/css/app.css" />
    </head>
    <body>
        <div id="app">
            @if (Auth::check())
                <div class="navigation">
                    <div class="wrapper">
                        <ul>
                            <li>
                                <a href="/dashboard"><i class="fa fa-home"></i> @lang('general.dashboard')</a>
                            </li>
                            <li>
                                <a href="/search"><i class="fa fa-search"></i> @lang('general.search')</a>
                            </li>
                            <li>
                                <a href="/tags"><i class="fa fa-tag"></i> @lang('general.tags')</a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="/settings"><i class="fa fa-cog"></i> @lang('general.settings')</a>
                            </li>
                            <li>
                                <a href="/logout"><i class="fa fa-power-off"></i> @lang('general.logout')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
            @yield('body')
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
