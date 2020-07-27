<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\StripeClient;

class SyncStripeSubscriptions implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $stripe = new StripeClient(config('stripe.secret'));

        foreach ($stripe->customers->all() as $stripeCustomer) {
            $user = User::where('stripe_customer_id', $stripeCustomer->id)->first();

            if (!$user) {
                continue;
            }

            $hasPremiumPlan = false;

            foreach ($stripeCustomer->subscriptions as $stripeSubscription) {
                if ($stripeSubscription->status !== 'active') {
                    continue;
                }

                $hasPremiumPlan = true;
            }

            if ($user->plan === 'standard' && $hasPremiumPlan) {
                $user->update(['plan' => 'premium']);
            }

            if ($user->plan === 'premium' && !$hasPremiumPlan) {
                $user->update(['plan' => 'standard']);
            }
        }
    }
}
