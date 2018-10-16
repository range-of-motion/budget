<?php

namespace App\Providers;

use App\Import;
use App\Policies\ImportPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\RecurringPolicy;
use App\Recurring;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Earning' => 'App\Policies\EarningPolicy',
        'App\Spending' => 'App\Policies\SpendingPolicy',
        Recurring::class => RecurringPolicy::class,
        'App\Tag' => 'App\Policies\TagPolicy',
        Import::class => ImportPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
