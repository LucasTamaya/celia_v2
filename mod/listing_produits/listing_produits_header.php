<?php
// Test pour suppression produit
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {

    $produit = $_GET['id'];

    // Suppression du produit
    sql_simple_delete('t_produit', $_GET['delete_id']);

    //suppr fichier image

    @unlink('pic/images/produits/'.$produit);

    // Redirection vers le listing des produit
    header("location: index.php?page=listing_produits");
}

// Requete SQL
$sql = 'SELECT id,titre,prix FROM t_produit';

// Execution requete
$rs = query($sql);

$html = '';




$html .='<div class="zone_contenu_clean">';
$html .= '   <div class="form-style">';
$html .= '       <h1>Listing Pays<span>Listing des pays dans le site...</span></h1>';

// Bouton Ajout d'un utilisateur
$html .= '   <div class="new_pays">';
$html .= '       <a href="index.php?page=administration_produits">';
$html .= '           Ajout produit';
$html .= '       </a>';
$html .= '   </div>';

// Test retour requete
if($rs && mysqli_num_rows($rs)){
    // Première ligne du tableau
    $html .= '        <table style="width:80%;margin:auto;padding:20px;" cellspacing="0" cellpadding="0">';
    $html .= '              <tr class="tab_header">';
    $html .= '                  <td class="tab_td">ID</td>';
    $html .= '                  <td class="tab_td">Nom</td>';
    $html .= '                  <td class="tab_td" style="width:100px;">&nbsp;</td>';
    $html .= '              </tr>';

    $i = 0;
    // Parcours des resultats
    while($data_produits = mysqli_fetch_assoc($rs)){
        $i++;
        // Boucle qui parcours les resultats de la requete
        if ($i % 2)
            $html .= '       <tr class="tab_row_1">';
        else
            $html .= '       <tr class="tab_row_2">';

        $html.= '            <td class="tab_td">'.$data_produits['id'].'</td>';
        $html.= '            <td class="tab_td">'.$data_produits['titre'].'</td>';
        $html.= '            <td class="tab_td">'.$data_produits['prix'].'</td>';

        // Actions
        $html.= '            <td class="tab_td">';
        $html.= '                <a href="index.php?page=administration_produits&id='.$data_produits['id'].'">';
        $html.= '                    Editer le produit';
        $html.= '                </a>';
        $html.= '                <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_produits&delete_id='.$data_produits['id'].'">';
        $html.= '                    supprimer le produit';
        $html.= '                </a>';
        $html.= '             </td>';
        $html.= '        </tr>';
    }

    $html.= '        </table>';
    $html.= '   </div>';
    $html.= '</div>';

}

?>
