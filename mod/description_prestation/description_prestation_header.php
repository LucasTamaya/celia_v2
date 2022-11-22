<?php
$html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5"> Cébeauté </h1>' ;
    if (isset($_GET['id'])  && !empty($_GET['id'])) {
        $id_produit = $_GET['id'];
    
        // Recuperer le nom de l'image
        $sql = "SELECT * FROM t_produit t INNER JOIN  t_categorie c ON t.fk_categorie = c.id WHERE t.id=" . $id_produit;
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs)) {
            while ($data = mysqli_fetch_assoc($rs)) {
                
                $html .='<div class="max-w-5xl mx-auto rounded grid grid-cols-1 lg:grid-cols-2 gap-5 my-10">';
                $html .='<div class="flex justify-center items-center">';
                $html .='<img src="images/produits/'.$data['fichier'].'">';
                $html .='</div>';
                $html .='<div class="flex flex-col justify-center items-center">';
                $html .='<h2 class="text-center text-3xl text-blue-900 font-semibold my-5"> '.$data['titre'].' </h2>';
                $html .='<p class="text-center text-xl text-blue-900 font-semibold my-5">'.$data['description'].'</p>';
                $html .='<div class="flex justify-center items-center gap-5">';
                $html .='<p class="text-center text-xl text-blue-900 font-semibold my-5">'.$data['prix'].'&euro;</p>';
                $html .='<p class="text-center text-xl text-blue-900 font-semibold my-5">'.$data['temps'].'min</p>';
                $html .='</div>'; 
                $html .='<h2 class="text-center text-lg text-blue-900 font-semibold my-5"> '.$data['nom'].' </h2> '; 
                $html .= '  <a class="block w-full py-2 rounded text-white text-center text-yellow-300 font-bold bg-blue-900" href="index.php?page=prestations&id=' . $data['id'] . '"> Ajouter au panier </a>'; 
                $html .='</div>'; 
                $html .='</div>';
            }
        }
    }

?>