<?php
require_once 'vendor/autoload.php';

$stripe_ids = array();

// recupere les ids des produits de panier dans le tableau
if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
    foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
        $stripe_id = squery('SELECT id_stripe FROM t_produit WHERE id= ' . $data_panier['fk_produit']);
        if ($stripe_id)
            array_push($stripe_ids, $stripe_id);
    }
}

$line_items = array();

// créer le line_items pour stripe checkout
foreach ($stripe_ids as $id) {
    echo $id;
    $line_items[] = [
        "price" => $id,
        "quantity" => 1 //a changer
    ];
}

\Stripe\Stripe::setApiKey('sk_test_51M4dVDJ4pxonshwwhg1hrK51sAxCGYBzPZ0Ziz0dMhdAAnrSu4h5cpoELWfTYzjfHftqOWK8iuACQHY3H08VD47h00SUsktR8p');

header('Content-Type: application/json');

$BASE_URL = "https://localhost/htdocs/celia_v2";

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => $line_items,
    'mode' => 'payment',
    'success_url' => $BASE_URL . '/index.php?page=remerciement',
    'cancel_url' => $BASE_URL . '/index.php?page=panier',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>

<title>CéBeauté - Confirmation du paiement</title>