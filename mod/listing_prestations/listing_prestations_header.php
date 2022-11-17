<?php
$html = "";
if (user_is_admin()) {
    // Test pour suppression produit
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {

        $produit = $_GET['id'];
        $image = squery("SELECT fichier FROM t_produit WHERE id=" . $id_produit);
        // Suppression du produit
        sql_simple_delete('t_produit', $_GET['delete_id']);

        //suppr fichier image

        @unlink('images/produits/' . $produit);

        // Redirection vers le listing des produit
        header("location: index.php?page=listing_prestations");
    }

    // Requete SQL
    $sql = 'SELECT id,titre,prix FROM t_produit';

    // Execution requete
    $rs = query($sql);

    $html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Listing prestations</h1>';
    $html .= '<ul class="max-w-4xl mx-auto">';
    // Test retour requete
    if ($rs && mysqli_num_rows($rs)) {
        // Parcours des resultats
        while ($data_produits = mysqli_fetch_assoc($rs)) {
            $html .= '<li class="grid bg-white grid-cols-5 border p-2 rounded mb-3">';
            $html .= '      <div><span class="text-sm font-bold">ID:</span> ' . $data_produits['id'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">Titre:</span> ' . $data_produits['titre'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">Prix:</span> ' . $data_produits['prix'] . '&euro;</div>';

            // Actions
            $html .= '      <a class="text-blue-500 underline" href="index.php?page=administration_prestations&id=' . $data_produits['id'] . '">';
            $html .= '                    Éditer';
            $html .= '      </a>';
            $html .= '      <a class="text-red-500 underline" onclick="if(window.confirm(\'Confirmer la suppression du produit ?\')) return true; else return false;" href="index.php?page=listing_prestations&delete_id=' . $data_produits['id'] . '">';
            $html .= '                    Supprimer';
            $html .= '      </a>';
            $html .= '</li>';
        }
        $html .= '</ul>';
    }
}
