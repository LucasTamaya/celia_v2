<?php

$html = "";
if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
    foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
        // echo $data_panier['fk_produit'] . ' / ' . $data_panier['quantite'] . '<br/>';
        $sql = 'SELECT * FROM t_produit WHERE id= ' . $data_panier['fk_produit'] . '';
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs)) {
            // Parcours des resultats
            $data_produits = mysqli_fetch_assoc($rs);
            $html .= '<li class="grid bg-white grid-cols-5 border p-2 rounded mb-3">';
            $html .= '      <img src="images/produits/' . $data_produits['fichier'] . '"';
            $html .= '      <div><span class="text-sm font-bold">titre:</span> ' . $data_produits['titre'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">temps:</span> ' . $data_produits['temps'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">prix:</span> ' . $data_produits['prix'] . '&euro;</div>';
            $html .= '</li>';
        }
    }
} else {
    $html .= "<h1> Votre panier est vide ! </h1>";
}
