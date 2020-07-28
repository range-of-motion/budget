<!DOCTYPE html>
<html>
    <body>
        <script src="https://js.stripe.com/v3"></script>
        <script>
        var stripe = Stripe("{{ config('stripe.key') }}");

        stripe.redirectToCheckout({
            sessionId: '{{ $stripeCheckoutId }}'
        }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
        });
        </script>
    </body>
</html>
