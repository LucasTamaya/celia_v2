<?php
$html = '<div class="traiDoree h-1"></div>';
$html .= '<div class="flex flex-row justify-center items-center bg-white">';
$html .= '<img class="w-28 h-10" src="images\cildroreegauche.PNG"><h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Détails</h1><img class="w-28 h-10" src="images\cilsdoreedroite.PNG">';
$html .= '</div>';
$html .= '<div class="traiDoree h-1"></div>';
    if (isset($_GET['id'])  && !empty($_GET['id'])) {
        $id_produit = $_GET['id'];
    
        // Recuperer le nom de l'image
        $sql = "SELECT * FROM t_produit t INNER JOIN  t_categorie c ON t.fk_categorie = c.id WHERE t.id=" . $id_produit;
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs)) {
            while ($data = mysqli_fetch_assoc($rs)) {
                
                $html .='<div class="max-w-5xl mx-8 lg:mx-auto rounded grid grid-cols-1 lg:grid-cols-2 gap-5 my-16 bg-white border-2 border-yellow-300">';
                $html .='<div class="flex justify-center items-center">';
                $html .='<img src="images/produits/'.$data['fichier'].'">';
                $html .='</div>';
                $html .='<div class="flex flex-col justify-center items-center text-blue-900">';
                $html .='<h2 class="text-center text-lg  font-semibold my-5"> '.$data['nom'].' </h2> '; 
                $html .='<h2 class="text-center text-3xl  font-semibold my-5"> '.$data['titre'].' </h2>';
                $html .='<p class="text-center text-xl  font-semibold my-5">'.$data['description'].'</p>';
                $html .='<div class="flex justify-center items-center gap-5">';
                $html .='<p class="text-center text-xl  font-semibold my-5">'.$data['prix'].'&euro;</p>';
                $html .='<p class="text-center text-xl  font-semibold my-5">'.$data['temps'].'min</p>';
                $html .='</div>'; 
                $html .= '  <a class="block w-full text-3xl py-2 rounded text-center text-yellow-300 font-bold" href="index.php?page=prestations&id=' . $data['id'] . '"> Ajouter au panier </a>'; 
                $html .='</div>'; 
                $html .='</div>';
            }
        }
    }

?>