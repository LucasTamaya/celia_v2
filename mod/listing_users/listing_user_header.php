<?php
$html = "";
if (user_is_admin()) {
    // Test pour suppression utilisateur
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {

        // Suppression de l'utilisateur
        sql_simple_delete('t_user', $_GET['delete_id']);

        // Redirection vers le listing des utilisateurs
        header("location: index.php?page=listing_user");
    }

    // Requete SQL
    $sql = 'SELECT id, nom, prenom FROM t_user';


    // Execution requete
    $rs = query($sql);

    $html = '';

    // Test retour requete
    if($rs && mysqli_num_rows($rs)){

        $html .='<div class="zone_contenu_clean">';
        $html .= '   <div class="form-style">';
        $html .= '       <h1>Listing Utilisateur<span>Listing des utilisateurs dans le site...</span></h1>';

        // Bouton Ajout d'un utilisateur
        $html .= '   <div class="new_user">';
        $html .= '       <a href="index.php?page=connection"> AJout un utilisateur';
        $html .= '       </a>';
        $html .= '   </div>';

        // Première ligne du tableau
        $html .= '        <table style="width:80%;margin:auto;padding:20px;" cellspacing="0" cellpadding="0">';
        $html .= '              <tr class="tab_header">';
        $html .= '                  <td class="tab_td">ID</td>';
        $html .= '                  <td class="tab_td">Nom</td>';
        $html .= '                  <td class="tab_td">Prénom</td>';
        $html .= '                  <td class="tab_td" style="width:100px;">&nbsp;</td>';
        $html .= '              </tr>';

        $i = 0;
        // Parcours des resultats
        while($data_user = mysqli_fetch_assoc($rs)){
            $i++;
            // Boucle qui parcours les resultats de la requete
            if ($i % 2)
                $html .= '       <tr class="tab_row_1">';
            else
                $html .= '       <tr class="tab_row_2">';

            $html.= '            <td class="tab_td">'.$data_user['id'].'</td>';
            $html.= '            <td class="tab_td">'.$data_user['nom'].'</td>';
            $html.= '            <td class="tab_td">'.$data_user['prenom'].'</td>';

            // Actions
            $html.= '            <td class="tab_td">';
            $html.= '                <a href="index.php?page=connection&id='.$data_user['id'].'">';
            $html.= '                    modifier l\'utilisteur';
            $html.= '                </a>';
            $html.= '                <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_user&delete_id='.$data_user['id'].'">';
            $html.= '                    supprimer l\'utilisteur';
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
