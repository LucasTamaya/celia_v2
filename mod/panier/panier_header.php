<?php

$montant_total_panier = 0;
$html = '';
$html .= '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Mon panier</h1>';
$html .= '<ul class="max-w-7xl mx-auto grid grid-cols-3 gap-5">';
$stripe_ids = array();

if (isset($_GET['paiement'])) {
    if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
        foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
            $sql = 'SELECT id_stripe FROM t_produit WHERE id= ' . $data_panier['fk_produit'] . '';
            $rs = query($sql);
            if ($rs && mysqli_num_rows($rs)) {
                $data = mysqli_fetch_assoc($rs);
                echo $data['id_stripe'];
            }
        }
    }
}

if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
    foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
        $sql = 'SELECT * FROM t_produit WHERE id= ' . $data_panier['fk_produit'] . '';
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs)) {
            // Parcours des resultats
            $data_produits = mysqli_fetch_assoc($rs);
            // récupère les ids stripe dans un tableau
            array_push($stripe_ids, $data_produits['id_stripe']);
            $montant_total_panier += floatval($data_produits['prix']);
            $html .= '<li>';
            $html .= '  <h2 class="text-2xl font-bold mb-2">' . $data_produits['titre'] . '</h2>';
            $html .= '  <div class="flex justify-between items-center mb-2">';
            $html .= '      <p>' . $data_produits['prix'] . '&euro;</p>';
            $html .= '      <p>' . $data_produits['temps'] . 'min</p>';
            $html .= '  </div>';
            $html .= '</li>';
        }
    }
    $html .= '</ul>';

    // affichage montant total du panier
    $html .= '<div class="w-full flex justify-center mt-5">';
    $html .= '  <a href="index.php?page=confirmation_paiement" class="w-full max-w-7xl text-white text-center font-semibold bg-blue-900 rounded py-2 mx-auto">Confirmez et payez ' . $montant_total_panier . '&euro;</a>';
    $html .= '</div>';
} else {
    $html .= "<h1> Votre panier est vide ! </h1>";
}
