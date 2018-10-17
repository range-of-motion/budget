<?php

namespace App\Providers;

use App\Earning;
use App\Import;
use App\Policies\EarningPolicy;
use App\Policies\ImportPolicy;
use App\Policies\SpendingPolicy;
use App\Policies\TagPolicy;
use App\Spending;
use App\Tag;
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
        Earning::class => EarningPolicy::class,
        Spending::class => SpendingPolicy::class,
        Recurring::class => RecurringPolicy::class,
        Tag::class => TagPolicy::class,
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
