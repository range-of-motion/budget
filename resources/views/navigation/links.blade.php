<li>
    <a href="{{ route('index') }}" {!! (Request::path() == 'dashboard') ? 'class="active"' : '' !!}><i class="fas fa-home fa-sm color-blue"></i> <span class="md:flex hidden ml-05">{{ __('general.dashboard') }}</span></a>
</li>
<li>
    <a href="{{ route('transactions.index') }}" {!! (Request::path() == 'transactions') ? 'class="active"' : '' !!}><i class="fas fa-exchange-alt fa-sm color-green"></i> <span class="md:flex hidden ml-05">{{ __('models.transactions') }}</span></a>
</li>
<li>
    <a href="{{ route('budgets.index') }}" {!! (Request::path() == 'budgets') ? 'class="active"' : '' !!}><i class="fas fa-wallet fa-sm color-red"></i> <span class="md:flex hidden ml-05">{{ __('models.budgets') }}</span></a>
</li>
<li>
    <a href="{{ route('tags.index') }}" {!! (Request::path() == 'tags') ? 'class="active"' : '' !!}><i class="fas fa-tag fa-sm color-blue"></i> <span class="md:flex hidden ml-05">{{ __('models.tags') }}</span></a>
</li>
<li>
    <a href="{{ route('reports.index') }}" {!! (Request::path() == 'reports') ? 'class="active"' : '' !!}><i class="fas fa-chart-line fa-sm color-green"></i> <span class="md:flex hidden ml-05">{{ __('pages.reports') }}</span></a>
</li>
