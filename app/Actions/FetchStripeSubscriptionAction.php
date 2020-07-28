<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserStripelessException;
use App\Models\User;
use Stripe\StripeClient;
use Stripe\Subscription;

class FetchStripeSubscriptionAction
{
    public function execute(int $userId): ?Subscription
    {
        $user = User::find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!$user->stripe_customer_id) {
            throw new UserStripelessException();
        }

        $stripe = new StripeClient(config('stripe.secret'));

        $stripeCustomer = $stripe->customers->retrieve($user->stripe_customer_id);

        return $stripeCustomer->subscriptions->first();
    }
}
