<?php

namespace App\Actions;

use App\Exceptions\PossibleSpaceAbandonmentException;
use App\Exceptions\UserActiveStripeSubscriptionException;
use App\Exceptions\UserNotFoundException;
use App\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Stripe\StripeClient;

class DeleteUserAction
{
    public function execute(int $id): void
    {
        $user = User::find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        // Checks before deleting
        if (Helper::arePlansEnabled() && $user->stripe_customer_id) {
            $stripe = new StripeClient(config('stripe.secret'));

            $stripeSubscriptions = $stripe->subscriptions->all([
                'customer' => $user->stripe_customer_id,
                'status' => 'active'
            ]);

            $activeStripeSubscriptions = 0;

            foreach ($stripeSubscriptions as $subscription) {
                // Determine whether or not subscription is active by looking at "ended_at"
                if (!$subscription->ended_at) {
                    $activeStripeSubscriptions++;
                }
            }

            if ($activeStripeSubscriptions > 0) {
                throw new UserActiveStripeSubscriptionException();
            }
        }

        // Commit to deleting
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }

        if (Helper::arePlansEnabled() && $user->stripe_customer_id) {
            $stripe = new StripeClient(config('stripe.secret'));

            $stripe->customers->delete($user->stripe_customer_id);
        }

        $user->fill([
            'avatar' => null,
            'name' => null,
            'email' => null,
            'stripe_customer_id' => null
        ])->save();
    }
}
