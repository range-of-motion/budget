<!DOCTYPE html>
<html class="{{ Auth::check() ? Auth::user()->theme : ''}}">
    <head>
        <title>{{ View::hasSection('title') ? View::getSection('title') . ' - ' . config('app.name') : config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="/twemoji-flags.css" />
        <script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/all.js" integrity="sha384-G/ZR3ntz68JZrH4pfPJyRbjW+c0+ojii5f+GYiYwldYU69A+Ejat6yIfLSxljXxD" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:400,400i,600,600i" />
        <link rel="stylesheet" href="/css/tailwind.css" />
        <link rel="stylesheet" href="/css/app.css" />
        <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" />
        <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
        <link rel="manifest" href="/site.webmanifest" />
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5" />
        <meta name="msapplication-TileColor" content="#da532c" />
        <meta name="theme-color" content="#ffffff" />
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
        @livewireStyles
    </head>
    <body class="bg-gray-50 theme-{{ Auth::check() ? Auth::user()->theme : 'light' }}">
        <div id="app">
            @if (Auth::check())
                @include('navigation.menu')
            @endif
            @if (Auth::check() && Auth::user()->verification_token)
                <div class="text-center" style="
                    padding: 15px;
                    color: #FFF;
                    background: #F86380;
                ">{!! __('general.verify_account') !!} ({{ __('general.or') }} <form method="POST" action="{{ route('resend_verification_mail') }}" style="display: inline-block;">{{ csrf_field() }}<button class="button link">
                    {{ strtolower(__('actions.resent')) }}</button></form>)</div>
            @endif
            @if (session('verification_mail_status'))
                <div class="wrapper mt-3">
                    @switch(session('verification_mail_status'))
                        @case('success')
                            @include('partials.alerts.success', ['payload' => ['classes' => '', 'message' => 'An e-mail has been sent your way']])
                            @break

                        @case('already_verified')
                            @include('partials.alerts.danger', ['payload' => ['classes' => '', 'message' => 'You\'ve already been verified']])
                            @break

                        @case('rate_limited')
                            @include('partials.alerts.danger', ['payload' => ['classes' => '', 'message' => 'Please wait a few minutes before requesting another e-mail']])
                            @break
                    @endswitch
                </div>
            @endif
            @yield('body')
            @if (auth()->check())
                <div class="text-center mb-3">
                    @if ($suggestionBoxEnabled)
                        <a class="fs-sm" href="/ideas/create">{{ __('general.got_a_suggestion') }}?</a> &middot; {{ $versionNumber }}
                    @else
                        {{ $versionNumber }}
                    @endif
                </div>
            @endif
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
        @livewireScripts
    </body>
</html>
