<?php
$html = "";

foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
    echo $data_panier['fk_produit'] . ' / ' . $data_panier['quantite'] . '<br/>';
}
