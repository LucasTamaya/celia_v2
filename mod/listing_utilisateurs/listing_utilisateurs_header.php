<?php
$html = "";
if (user_is_admin()) {
    // Test pour suppression utilisateur
    if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {

        // Suppression de l'utilisateur
        sql_simple_delete('t_user', $_GET['delete_id']);

        // Redirection vers le listing des utilisateurs
        header("location: index.php?page=listing_utilisateurs");
    }

    // Requete SQL
    $sql = 'SELECT id, nom, prenom FROM t_user WHERE isAdmin != 1';


    // Execution requete
    $rs = query($sql);

    $html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Listing utilisateurs</h1>';
    $html .= '<ul class="max-w-4xl mx-auto">';
    // Test retour requete
    if ($rs && mysqli_num_rows($rs)) {
        // Parcours des resultats
        while ($data_user = mysqli_fetch_assoc($rs)) {
            $html .= '<li class="grid bg-white grid-cols-5 border p-2 rounded mb-3">';
            $html .= '      <div><span class="text-sm font-bold">ID:</span> ' . $data_user['id'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">Nom:</span> ' . $data_user['nom'] . '</div>';
            $html .= '      <div><span class="text-sm font-bold">Prénom:</span> ' . $data_user['prenom'] . '</div>';
            // Actions
            $html .= '      <a class="text-red-500 underline" onclick="if(window.confirm(\'Confirmer la suppression de cette utilisateur ?\')) return true; else return false;" href="index.php?page=listing_utilisateurs&delete_id=' . $data_user['id'] . '">';
            $html .= '                    Supprimer';
            $html .= '      </a>';
            $html .= '</li>';
        }
        $html .= '</ul>';
    }
}
