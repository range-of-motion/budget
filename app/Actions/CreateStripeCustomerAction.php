<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Stripe\StripeClient;

class CreateStripeCustomerAction
{
    public function execute(int $userId): void
    {
        $user = User::find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $stripe = new StripeClient(config('stripe.secret'));

        $customer = $stripe->customers->create([
            'name' => $user->name,
            'email' => $user->email
        ]);

        $user->update([
            'stripe_customer_id' => $customer->id
        ]);
    }
}
