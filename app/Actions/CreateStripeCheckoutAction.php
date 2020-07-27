<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\UserStripelessException;
use App\Models\User;
use Stripe\StripeClient;

class CreateStripeCheckoutAction
{
    public function execute(int $userId): string
    {
        $user = User::find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!$user->stripe_customer_id) {
            throw new UserStripelessException();
        }

        $stripe = new StripeClient(config('stripe.secret'));

        $stripeCheckout = $stripe->checkout->sessions->create([
            'success_url' => route('settings.billing'),
            'cancel_url' => route('settings.billing'),
            'mode' => 'subscription',
            'payment_method_types' => ['card'],
            'customer' => $user->stripe_customer_id,
            'line_items' => [
                [
                    'price' => config('stripe.premium_plan_price_id'),
                    'quantity' => 1
                ]
            ]
        ]);

        return $stripeCheckout->id;
    }
}
