<?php
$html = '<div class="traiDoree h-1"></div>';
$html .= '<div class="flex flex-row justify-center items-center bg-white">';
$html .= '<img class="w-28 h-10" src="images\cildroreegauche.PNG"><h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Prestations</h1><img class="w-28 h-10" src="images\cilsdoreedroite.PNG">';
$html .= '</div>';
$html .= '<div class="traiDoree h-1"></div>';

if (!isset($_GET['fk_categorie'])) {
$html .= ' <div class="grid grid-cols-2 my-24 w-fit mx-auto gap-24">';
$html .= '          <div class="flex"><a href="index.php?page=prestations&fk_categorie=1"><div class="bgimg h-80 w-80"></div> <div><h2 class="text-lg text-center text-white font-semibold">Epilations</h2></div></a></div>';
$html .= '          <div class="flex"><a href="index.php?page=prestations&fk_categorie=2"><div class="bgimg h-80 w-80"></div> <div><h2 class="text-lg text-center text-white font-semibold">Soins</h2></div></a></div>';
$html .= '          <div class="flex"><a href="index.php?page=prestations&fk_categorie=3"><div class="bgimg h-80 w-80"></div> <div><h2 class="text-lg text-center text-white font-semibold">Cils & Sourcils</h2></div></a></div>';
$html .= '          <div class="flex"><a href="index.php?page=prestations&fk_categorie=4"><div class="bgimg h-80 w-80"></div> <div><h2 class="text-lg text-center text-white font-semibold">Onglerie</h2></div></a></div>';
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
    $html .= '<ul class="max-w-7xl mx-auto my-10 rounded grid grid-cols-1 lg:grid-cols-2 gap-5 text-center">';
    $html .= '<li class="border-2 border-yellow-300 rounded mx-8 my-10 lg:hidden">';
    $html .= ' <div class="grid grid-cols-5 justify-center items-center my-2 mx-5 text-white">';
    $html .= '  <h2 class="text-lg">Prestation</h2>';
    $html .= '      <p>Prix</p>';
    $html .= '      <p>Durée</p>';
    $html .= '  <p>Détails</p>';
    $html .= '  <p>Ajouter au panier</p>';
    $html .= '  </div>';
    $html .= '</li>';

    if ($rs_categorie && mysqli_num_rows($rs_categorie)) {
        while ($data_produits = mysqli_fetch_assoc($rs_categorie)) {
            $html .= '<li class="border-2 border-yellow-300 rounded mx-8 bg-white">';
            $html .= ' <div class="grid grid-cols-5 justify-center items-center my-2 mx-5 text-blue-900">';
            $html .= '  <h2 class="text-lg">' . $data_produits['titre'] . '</h2>';
            $html .= '      <p>' . $data_produits['prix'] . '&euro;</p>';
            $html .= '      <p>' . $data_produits['temps'] . 'min</p>';
            $html .= '  <a href="index.php?page=description_prestation&id=' . $data_produits['id'] . '"><i class="far fa-eye"></i></a>';
            $html .= '  <a  href="index.php?page=prestations&id=' . $data_produits['id'] . '"><i class="fas fa-shopping-cart"></i></a>';
            $html .= '  </div>';
            $html .= '</li>';
        }
        $html .= '</ul>';
    }

} 

?>
