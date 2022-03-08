<div class="navigation">
    <div class="wrapper">
        <ul class="navigation__menu">
            @include('navigation.links')
        </ul>
        <ul class="navigation__menu">
            <li>
                <button-dropdown>
                    <a slot="button" href="{{ route('transactions.create') }}">{{ __('actions.create') }} {{ __('models.transaction') }}</a>
                    <ul slot="menu" v-cloak>
                        <li>
                            <a href="{{ route('tags.create') }}">{{ __('actions.create') }} {{ __('models.tag') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('imports.create') }}">{{ __('actions.create') }} {{ __('models.import') }}</a>
                        </li>
                    </ul>
                </button-dropdown>
            </li>
            <li>
                <a href="{{ route('activities.index') }}">
                    <i class="fas fa-clock"></i>
                </a>
            </li>
            @if (Auth::user()->spaces->count() > 1)
                <li>
                    <dropdown>
                        <span slot="button">
                            {{ $selectedSpace->abbreviated_name }} <i class="fas fa-caret-down fa-sm"></i>
                        </span>
                        <ul slot="menu" v-cloak>
                            @foreach (Auth::user()->spaces as $space)
                                <li>
                                    <a href="{{ route('spaces.show', ['space' => $space->id])  }}" v-pre>{{ $space->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </dropdown>
                </li>
            @endif
            <li>
                <dropdown>
                    <span slot="button" class="flex">
                        <img src="{{ Auth::user()->avatar }}" class="avatar mr-05" /> <i class="fas fa-caret-down fa-sm"></i>
                    </span>
                    <ul slot="menu" v-cloak>
                        <li>
                            <a href="{{ route('imports.index') }}">{{ __('models.imports') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('settings.index') }}">{{ __('pages.settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">{{ __('pages.log_out') }}</a>
                        </li>
                    </ul>
                </dropdown>
            </li>
        </ul>
    </div>
</div>
