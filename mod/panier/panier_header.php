<?php

$montant_total_panier = 0;
$html = '<div class="min-h-[80vh] flex flex-col">';
$html .= '<div class="traiDoree h-1"></div>';
$html .= '<div class="flex flex-row justify-center items-center bg-white overflow-hidden">';
$html .= '<img class="w-28 h-10 rotate-[-20deg]" src="images\cildroreegauche.PNG"><h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Panier</h1><img class=" w-28 h-10 rotate-[-40deg]" src="images\gauche.PNG">';
$html .= '</div>';
$html .= '<div class="traiDoree h-1"></div>';
$html .= '<ul class="max-w-7xl mx-auto grid grid-cols-1 gap-5 mt-8">';

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
            $html .= '<li class="flex justify-center items-center my-2 mx-5 gap-16 border-2 border-yellow-300 rounded bg-white text-blue-900">';
            $html .= '  <h2 class="text-xl font-bold my-2 ml-2">' . $data_produits['titre'] . '</h2>';
            $html .= '      <p>' . $data_produits['prix'] . '&euro;</p>';
            $html .= '      <p>' . $data_produits['temps'] . 'min</p>';
            $html .= '      <a class="text-red-500 underline mr-2" onclick="if(window.confirm(\'Confirmer la suppression du produit ?\')) return true; else return false;" href="index.php?page=panier&delete_id=' . $data_produits['id'] . '">';
            $html .= '                    <i class="fas fa-trash-alt"></i>';
            $html .= '      </a>';
            $html .= '</li>';
        }
    }
    $html .= '</ul>';
    // affichage montant total du panier
    $html .= '<div class="w-full flex justify-center mt-5">';
    $html .= '  <a href="index.php?page=chargement_paiement" class="w-56 max-w-xl text-center font-semibold text-blue-900 bg-yellow-300 rounded py-2 mx-auto">Confirmez et payez ' . $montant_total_panier . '&euro;</a>';
    $html .= '</div>';
    $html .= '</div>';
} else {
    $html .= "<h1> Votre panier est vide ! </h1>";
    $html .= '</div>';
}
