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
    $sql = 'SELECT * FROM t_photo';


    // Execution requete
    $rs = query($sql);

    $html = '';

    // Test retour requete
    if($rs && mysqli_num_rows($rs)){

        $html .='<div class="zone_contenu_clean">';
        $html .= '   <div class="form-style">';
        $html .= '       <h1>Listing photo<span>Listing des photos</span></h1>';

        // Bouton Ajout d'un utilisateur
        $html .= '   <div class="new_user">';
        $html .= '       <a href="index.php?page=administration_photos"> AJout une photo';
        $html .= '       </a>';
        $html .= '   </div>';

        // Première ligne du tableau
        $html .= '        <table style="width:80%;margin:auto;padding:20px;" cellspacing="0" cellpadding="0">';
        $html .= '              <tr class="tab_header">';
        $html .= '                  <td class="tab_td">ID</td>';
        $html .= '                  <td class="tab_td">alt</td>';
        $html .= '                  <td class="tab_td">fichier</td>';
        $html .= '                  <td class="tab_td">ordre</td>';
        $html .= '                  <td class="tab_td" style="width:100px;">&nbsp;</td>';
        $html .= '              </tr>';

        $i = 0;
        // Parcours des resultats
        while($data_photo = mysqli_fetch_assoc($rs)){
            $i++;
            // Boucle qui parcours les resultats de la requete
            if ($i % 2)
                $html .= '       <tr class="tab_row_1">';
            else
                $html .= '       <tr class="tab_row_2">';

            $html.= '            <td class="tab_td">'.$data_photo['id'].'</td>';
            $html.= '            <td class="tab_td">'.$data_photo['alt'].'</td>';
            $html.= '            <td class="tab_td"><img src="images/galerie_image/'.$data_photo['fichier'].'"></td>';
            $html.= '            <td class="tab_td">'.$data_photo['ordre'].'</td>';

            // Actions
            $html.= '            <td class="tab_td">';
            // $html.= '                <a href="index.php?page=connection&id='.$data_photo['id'].'">';
            // $html.= '                    modifier la photo';
            // $html.= '                </a>';
            $html.= '                <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_galerie&delete_id='.$data_photo['id'].'">';
            $html.= '                    supprimer la photo';
            $html.= '                </a>';
            $html.= '             </td>';
            $html.= '        </tr>';
        }

        $html.= '        </table>';
        $html.= '   </div>';
        $html.= '</div>';

    }
}
?>
