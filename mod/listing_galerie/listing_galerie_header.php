<?php
$html = "";
if (user_is_admin()) {
    
    if (isset($_GET['delete_id'])  && !empty($_GET['delete_id'])) {
        $id_suppr = $_GET['delete_id'];
    
        // Recuperer le nom de l'image
        $image = squery("SELECT fichier FROM t_photo WHERE id=" . $id_suppr);
    
        // Supprimer l'enregistrement en BDD
        sql_simple_delete('t_photo', $id_suppr);
    
        // Supprimer le fichier sur le disque
        @unlink('images/galerie_image/' . $image);
    
        // Redirection
        header('location: index.php?page=listing_galerie');
    }

    // Requete SQL
    $sql = 'SELECT * FROM t_photo ORDER BY ordre DESC';


    // Execution requete
    $rs = query($sql);

    $html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Listing photo</h1>';


            // Bouton Ajout d'un utilisateur
            $html .= '<div class="my-5 ml-16">';
            $html .= '       <a href="index.php?page=administration_galerie"><span class="text-center text-m text-yellow-500 font-semibold"> Ajouter une photo</span>';
            $html .= '       </a>';
            $html .= '</div>';
            
    // Test retour requete
    if($rs && mysqli_num_rows($rs)){

        


        $html .= '<ul class="max-w-4xl mx-auto">';


        $i = 0;
        // Parcours des resultats
        while($data_photo = mysqli_fetch_assoc($rs)){
            $html .= '<li class="grid bg-white grid-cols-6 border p-2 rounded mb-3">';

            $html .= '      <div><span class="text-sm font-bold">ID:</span> ' . $data_photo['id'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">Alt:</span> '.$data_photo['alt'].'</div>';
            $html .= '      <div><span class="text-sm font-bold">Image:</span><a href="images/galerie_image/'.$data_photo['fichier'].'"><img class="w-28 h-16" src="images/galerie_image/'.$data_photo['fichier'].'"></a></div>';
            $html .= '      <div><span class="text-sm font-bold">ordre:</span>'.$data_photo['ordre'].'</div>';


            // Actions

            $html .= '      <a class="text-red-500 underline" onclick="if(window.confirm(\'Confirmer la suppression du produit ?\')) return true; else return false;" href="index.php?page=listing_galerie&delete_id=' . $data_photo['id'] . '">';
            $html .= '                    Supprimer';
            $html .= '      </a>';
            $html .= '</li>';
        }
       
        $html .= '</ul>';
    }
}
