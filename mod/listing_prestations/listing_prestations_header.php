<?php
$html = "";
if (user_is_admin()) {
    // Test pour suppression produit
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {

        $produit = $_GET['id'];

        // Suppression du produit
        sql_simple_delete('t_produit', $_GET['delete_id']);

        //suppr fichier image

        @unlink('pic/images/produits/' . $produit);

        // Redirection vers le listing des produit
        header("location: index.php?page=listing_produits");
    }

    // Requete SQL
    $sql = 'SELECT id,titre,prix FROM t_produit';

    // Execution requete
    $rs = query($sql);

    $html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Listing Prestations</h1>';

    // Test retour requete
    if ($rs && mysqli_num_rows($rs)) {
        $html .= '<table class="w-full max-w-3xl mx-auto" cellspacing="0" cellpadding="15">';
        $html .= '    <tr>';
        $html .= '        <td class="text-blue-900 text-lg font-bold">ID</td>';
        $html .= '        <td class="text-blue-900 text-lg font-bold">Titre</td>';
        $html .= '        <td class="text-blue-900 text-lg font-bold">Prix</td>';
        $html .= '    </tr>';

        $i = 0;
        // Parcours des resultats
        while ($data_produits = mysqli_fetch_assoc($rs)) {
            $i++;
            $html .= '<tr class="border">';
            $html .= '      <td class="tab_td">' . $data_produits['id'] . '</td>';
            $html .= '      <td class="tab_td">' . $data_produits['titre'] . '</td>';
            $html .= '      <td class="tab_td">' . $data_produits['prix'] . '&euro;</td>';

            // Actions
            $html .= '      <td class="tab_td">';
            $html .= '          <a href="index.php?page=administration_prestations&id=' . $data_produits['id'] . '">';
            $html .= '                    Éditer';
            $html .= '          </a>';
            $html .= '          <a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=listing_produits&delete_id=' . $data_produits['id'] . '">';
            $html .= '                    Supprimer';
            $html .= '          </a>';
            $html .= '      </td>';
            $html .= '</tr>';
        }

        $html .= '        </table>';
    }
}
