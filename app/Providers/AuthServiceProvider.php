<?php

namespace App\Providers;

use App\Models\Earning;
use App\Models\Import;
use App\Policies\EarningPolicy;
use App\Policies\ImportPolicy;
use App\Policies\SpendingPolicy;
use App\Policies\TagPolicy;
use App\Models\Spending;
use App\Models\Tag;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\RecurringPolicy;
use App\Models\Recurring;
use App\Models\Space;
use App\Models\SpaceInvite;
use App\Policies\SpaceInvitePolicy;
use App\Policies\SpacePolicy;

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
        Space::class => SpacePolicy::class,
        SpaceInvite::class => SpaceInvitePolicy::class,
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
        //
    }
}
