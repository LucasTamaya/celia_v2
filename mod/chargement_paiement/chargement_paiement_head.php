<?php
$stripe_ids = array();

if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
    foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
        $stripe_id = squery('SELECT id_stripe FROM t_produit WHERE id= ' . $data_panier['fk_produit']);
        if ($stripe_id)
            array_push($stripe_ids, $stripe_id);

        $js = "";
        foreach ($stripe_ids as $id)
            $js .= $id . '#';


        $js = json_encode($stripe_ids);
    }
}


require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51M4dVDJ4pxonshwwhg1hrK51sAxCGYBzPZ0Ziz0dMhdAAnrSu4h5cpoELWfTYzjfHftqOWK8iuACQHY3H08VD47h00SUsktR8p');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:4242/public';

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => '{{PRICE_ID}}',
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.html',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>

<title>CéBeauté - Confirmation du paiement</title>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var ids = '<?php echo $js; ?>';

    const BASE_URL = "http://localhost/ifr/celia_v2"

    decodedIds = JSON.parse(ids);

    // création de l'instance stripe réliée à la boutique
    var stripe = Stripe(
        "pk_test_51M4dVDJ4pxonshww6jDpdczTupzhtVboHHSDp0i3e3U8LkBmB3Vg8v9O4s30h5Zg6MbShnltrZ3TlS915wElX7BF00PNfot4yG"
    );

    const get_stripe_session = async (lineItems) => {
        const url = await stripe.redirectToCheckout({
            mode: "payment",
            lineItems,
            successUrl: window.location.replace(`${BASE_URL}/index.php?page=remerciement`),
            // cancelUrl: window.location.replace(`${BASE_URL}/index.php?page=panier`),
        });

        window.location.replace(url)

        return url;
    };

    // création des lineItems
    const lineItems = decodedIds.map((id) => {
        return {
            price: id,
            quantity: 1
        };
    })

    get_stripe_session(lineItems);
</script>