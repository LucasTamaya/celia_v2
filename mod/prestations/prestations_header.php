<?php
 $html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Prestations</h1>';

if (!isset($_GET['fk_categorie'])) {
    $html .= '      <div class="max-w-3xl flex justify-center ">';
$html .= '          <div><a class="text-lg  font-semibold" href="index.php?page=prestations&fk_categorie=1">Epilations</a></div>';
$html .= '          <div><a class="text-lg  font-semibold" href="index.php?page=prestations&fk_categorie=2">Soins</a></div>';
$html .= '          <div><a class="text-lg  font-semibold" href="index.php?page=prestations&fk_categorie=3">Cils / Sourcils</a></div>';
$html .= '          <div><a class="text-lg  font-semibold" href="index.php?page=prestations&fk_categorie=4">Onglerie</a></div>';
$html .= '      </div>';
}



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
}
