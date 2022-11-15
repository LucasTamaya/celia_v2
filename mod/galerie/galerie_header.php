<?php
if (isset($_GET['id_suppr'])  && !empty($_GET['id_suppr'])) {
    $id_suppr = $_GET['id_suppr'];

    // Recuperer le nom de l'image
    $image = squery("SELECT fichier FROM t_photo WHERE id=" . $id_suppr);

    // Supprimer l'enregistrement en BDD
    sql_simple_delete('t_photo', $id_suppr);

    // Supprimer le fichier sur le disque
    @unlink('images/galerie_image/' . $image);

    // Redirection
    header('location: index.php?page=galerie_photo');
}



$html = "";
// Requete SQL
$sql = 'SELECT * FROM t_photo ORDER BY id DESC';

// Execution requete
$rs = query($sql);

$html .= '<h1 class="text-center text-3xl text-yellow-300 font-bold my-5">Galerie CeBeauté</h1>';

if ($rs && mysqli_num_rows($rs)) {
    $html .= '<div class="max-w-6xl mx-auto bg-red-500">';
    $html .= '  <div class="grid grid-cols-3 justify-between">';
    while ($data_photo = mysqli_fetch_assoc($rs)) {
        $html .= '  <img src="images/galerie_image/' . $data_photo['fichier'] . '" alt="' . $data_photo['alt'] . '" />';
    }
    $html .= '  </div>';
    $html .= '</div>';
}

?>
<script src="js/js.js"></script>