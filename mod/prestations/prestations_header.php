<?php
$html = ' <h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Prestations</h1>';
$html .= '<nav>';
$html .= '      <ul class="max-w-3xl flex justify-evenly mx-auto bg-blue-900 p-5 rounded mb-10">';
$html .= '          <li><a class="text-lg text-white font-semibold" href="index.php?page=prestations">Toutes les prestations</a></li>';
$html .= '          <li><a class="text-lg text-white font-semibold" href="index.php?page=prestations&fk_categorie=1">Epilations</a></li>';
$html .= '          <li><a class="text-lg text-white font-semibold" href="index.php?page=prestations&fk_categorie=2">Soins</a></li>';
$html .= '          <li><a class="text-lg text-white font-semibold" href="index.php?page=prestations&fk_categorie=3">Cils / Sourcils</a></li>';
$html .= '          <li><a class="text-lg text-white font-semibold" href="index.php?page=prestations&fk_categorie=4">Onglerie</a></li>';
$html .= '      </ul>';
$html .= '</nav>';

// ajout du produit au panier
if (isset($_GET['id'])) {
    $id_produit = $_GET['id'];
    array_push($_SESSION[SESSION_NAME]['panier'], array('fk_produit' => '' . $id_produit . '', 'quantite' => 1));
}

// sélection d'une catégorie
if (isset($_GET['fk_categorie'])) {
    $id_categorie = $_GET['fk_categorie'];
    $sql_categorie = "SELECT * FROM t_produit WHERE fk_categorie=" . $id_categorie;
    $rs_categorie = query($sql_categorie);
    $html .= '<ul class="max-w-7xl mx-auto rounded grid grid-cols-1 lg:grid-cols-2 gap-5">';

    if ($rs_categorie && mysqli_num_rows($rs_categorie)) {
        while ($data_produits = mysqli_fetch_assoc($rs_categorie)) {
            $html .= '<li class="border-2 border-yellow-300 rounded">';
            $html .= ' <div class="grid grid-cols-5 justify-center items-center my-2 mx-5">';
            $html .= '  <h2 class="text-lg font-bold mb-2">' . $data_produits['titre'] . '</h2>';
            $html .= '      <p>' . $data_produits['prix'] . '&euro;</p>';
            $html .= '      <p>' . $data_produits['temps'] . 'min</p>';
            $html .= '  <a href="index.php?page=description_prestation&id=' . $data_produits['id'] . '"><img src="images\voir.png"></a>';
            $html .= '  <a  href="index.php?page=prestations&id=' . $data_produits['id'] . '"><img src="images\shopping.png"></a>';
            $html .= '  </div>';
            $html .= '</li>';
        }
        $html .= '</ul>';
    }
} else {
    $sql_categorie = "SELECT * FROM t_produit";
    $rs_categorie = query($sql_categorie);
    $html .= '<ul class="max-w-7xl mx-auto rounded grid grid-cols-1 lg:grid-cols-2 gap-5">';
    //on stoque dans data
    if ($rs_categorie && mysqli_num_rows($rs_categorie)) {
        while ($data_produits = mysqli_fetch_assoc($rs_categorie)) {
            $html .= '<li class="border-2 border-yellow-300 rounded">';
            $html .= ' <div class="grid grid-cols-5 justify-between items-center my-2 mx-5">';
            $html .= '  <h2 class="text-lg font-bold mb-2">' . $data_produits['titre'] . '</h2>';
            $html .= '      <p>' . $data_produits['prix'] . '&euro;</p>';
            $html .= '      <p>' . $data_produits['temps'] . 'min</p>';
            $html .= '  <a href="index.php?page=description_prestation&id=' . $data_produits['id'] . '"><img src="images\voir.png"></a>';
            $html .= '  <a  href="index.php?page=prestations&id=' . $data_produits['id'] . '"><img src="images\shopping.png"></a>';
            $html .= '  </div>';
            $html .= '</li>';
        }
    }
    $html .= '</ul>';
}
