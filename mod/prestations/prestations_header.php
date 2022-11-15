<?php

   $html =' <h1> prestations </h1>';
   $html .='<h2><a href="index.php?page=prestations&fk_categorie=1">  Epilations  </a></h2>';
   $html .='<h2><a href="index.php?page=prestations&fk_categorie=2">  Soins  </a></h2>';
   $html .='<h2><a href="index.php?page=prestations&fk_categorie=3">  Cils/Sourcils  </a></h2>';
   $html .='<h2><a href="index.php?page=prestations&fk_categorie=4">  Onglerie  </a></h2>';
    

   if(isset($_GET['fk_categorie'])){
    
    $id_categorie = $_GET['fk_categorie'];

    // On recupere les produits par categorie depuis la bdd
    $sql_categorie = "SELECT * FROM t_produit WHERE fk_categorie=".$id_categorie;
    $rs_categorie = query($sql_categorie);
    //on stoque dans data
    if($rs_categorie && mysqli_num_rows($rs_categorie)){
        while($data_produits = mysqli_fetch_assoc($rs_categorie)){

            $html .='<div>';
            $html .='<h3> '.$data_produits['titre'].' </h3>';
            $html .='<img src="images/produits/'.$data_produits['fichier'].'" alt="'.$data_produits['description'].'" </img>';
            $html .='<p> '.$data_produits['prix'].' </p>';
            $html .='<p> '.$data_produits['temps'].' </p>';
            $html .='<p> '.$data_produits['description'].' </p>';
            $html .='<button id="'.$data_produits['id'].'"> Ajouter au panier </button>';
            $html .='</div>';


        }
    }
}else{
    $sql_categorie = "SELECT * FROM t_produit";
    $rs_categorie = query($sql_categorie);
    //on stoque dans data
    if($rs_categorie && mysqli_num_rows($rs_categorie)){
        while($data_produits = mysqli_fetch_assoc($rs_categorie)){

            $html .='<div>';
            $html .='<h3> '.$data_produits['titre'].' </h3>';
            $html .='<img src="images/produits/'.$data_produits['fichier'].'" alt="'.$data_produits['description'].'" </img>';
            $html .='<p> '.$data_produits['prix'].' </p>';
            $html .='<p> '.$data_produits['temps'].' </p>';
            $html .='<p> '.$data_produits['description'].' </p>';
            $html .='<button id="'.$data_produits['id'].'"> Ajouter au panier </button>';
            $html .='</div>';


        }
    }
}


?>




    
