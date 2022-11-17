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
?>

<title>CéBeauté - Confirmation du paiement</title>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var ids = '<?php echo $js; ?>';

    decodedIds = JSON.parse(ids);

    // création de l'instance stripe réliée à la boutique
    var stripe = Stripe(
        "pk_test_51M4dVDJ4pxonshww6jDpdczTupzhtVboHHSDp0i3e3U8LkBmB3Vg8v9O4s30h5Zg6MbShnltrZ3TlS915wElX7BF00PNfot4yG"
    );

    const get_stripe_session = async (lineItems) => {
        const url = await stripe.redirectToCheckout({
            mode: "payment",
            lineItems,
            successUrl: window.location.href,
            cancelUrl: window.location.href,
        });

        return url;
    };

    // création des lineItems
    const lineItems = decodedIds.map((id) => {
        return {
            price: id,
            quantity: 1
        };
    })

    // get_stripe_session(lineItems);
</script>