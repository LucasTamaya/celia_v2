<?php

$montant_total_panier = 0;
$html = '';
$html .= '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Mon panier</h1>';
$html .= '<ul class="max-w-7xl mx-auto grid grid-cols-1 gap-5">';

if (isset($_GET['paiement'])) {
    if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
        foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
            $sql = 'SELECT id_stripe FROM t_produit WHERE id= ' . $data_panier['fk_produit'] . '';
            $rs = query($sql);
            if ($rs && mysqli_num_rows($rs)) {
                $data = mysqli_fetch_assoc($rs);
            }
        }
    }
}

if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {

    $produit = $_GET['delete_id'];
    $image = squery("SELECT * FROM t_produit WHERE id=" . $id_produit);
    // Suppression du produit
    sql_simple_delete('t_produit', $_GET['delete_id']);

    // Redirection vers le listing des produit
    header("location: index.php?page=panier");
}

if (isset($_SESSION[SESSION_NAME]['panier']) && !empty($_SESSION[SESSION_NAME]['panier'])) {
    foreach ($_SESSION[SESSION_NAME]['panier'] as $data_panier) {
        $sql = 'SELECT * FROM t_produit WHERE id= ' . $data_panier['fk_produit'] . '';
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs)) {
            // Parcours des resultats
            $data_produits = mysqli_fetch_assoc($rs);
            $montant_total_panier += floatval($data_produits['prix']);
            $html .= '<li class="flex justify-center items-center my-4 mx-5 gap-16">';
            $html .= '  <h2 class="text-2xl font-bold mb-2">' . $data_produits['titre'] . '</h2>';
            $html .= '      <p>' . $data_produits['prix'] . '&euro;</p>';
            $html .= '      <p>' . $data_produits['temps'] . 'min</p>';
            $html .= '      <a class="text-red-500 underline" onclick="if(window.confirm(\'Confirmer la suppression du produit ?\')) return true; else return false;" href="index.php?page=panier&delete_id=' . $data_produits['id'] . '">';
            $html .= '                    Supprimer';
            $html .= '      </a>';
            $html .= '</li>';
        }
    }
    $html .= '</ul>';
    // affichage montant total du panier
    $html .= '<div class="w-full flex justify-center mt-5">';
    $html .= '  <a href="index.php?page=chargement_paiement" class="w-full max-w-xl text-white text-center font-semibold bg-blue-900 rounded py-2 mx-auto">Confirmez et payez ' . $montant_total_panier . '&euro;</a>';
    $html .= '</div>';
} else {
    $html .= "<h1> Votre panier est vide ! </h1>";
}
