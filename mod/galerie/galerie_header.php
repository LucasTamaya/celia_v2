<?php
<<<<<<< HEAD

=======
if (isset($_GET['id_suppr'])  && !empty($_GET['id_suppr'])) {
    $id_suppr = $_GET['id_suppr'];

    // Recuperer le nom de l'image
    $image = squery("SELECT fichier FROM t_photo WHERE id=" . $id_suppr);

    // Supprimer l'enregistrement en BDD
    sql_simple_delete('t_photo', $id_suppr);

    // Supprimer le fichier sur le disque
    @unlink('images/galerie_image/' . $image);

    // Redirection
    header('location: index.php?page=galerie');
}

>>>>>>> 909b7a42520a13b01bc4e17d7a088ad194ce10cb
$sql = 'SELECT * FROM t_photo ORDER BY id DESC';

// Execution requete
$rs = query($sql);

$html = '<h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Galerie des prestations</h1>';
<<<<<<< HEAD
$html .= '<div class="grid bg-gradient-to-r from-blue-900 to-yellow-300">';
$html .= '<div class="grid-sizer"></div>';
if ($rs && mysqli_num_rows($rs)) {
    while ($data_photo = mysqli_fetch_assoc($rs)) {
        $html .= '<div class="grid-item "><img class="grid-item-content" src="images/galerie_image/' . $data_photo['fichier'] . '" alt="' . $data_photo['alt'] . '" /></div>';
    }
}
$html .= '</div>';
$html .= '<script src="https://masonry.desandro.com/masonry.pkgd.js"></script>';
$html .= '<script src="js/galerie.js"></script>';


?>

=======
$html .= '<div class="max-w-7xl grid grid-cols-4 bg-white mx-auto">';
if ($rs && mysqli_num_rows($rs)) {
    while ($data_photo = mysqli_fetch_assoc($rs)) {
        $html .= '<img class="p-2" src="images/galerie_image/' . $data_photo['fichier'] . '" alt="' . $data_photo['alt'] . '" />';
    }
}
$html .= '</div>';


?>
<script src="js/js.js"></script>
>>>>>>> 909b7a42520a13b01bc4e17d7a088ad194ce10cb
