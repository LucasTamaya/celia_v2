<?php
$sql = 'SELECT * FROM t_photo ORDER BY id DESC';

// Execution requete
$rs = query($sql);
$html = '<div class="flex flex-row justify-center items-center ">';
$html .= '<img class="w-28 h-10" src="images\cildroreegauche.PNG"><h1 class="text-center text-3xl text-blue-900 font-semibold my-5">Galerie Photos</h1><img class="w-28 h-10" src="images\cilsdoreedroite.PNG">';
$html .= '</div>';
$html .='<div class="bg_image">';
$html .= '<div class="grid">';
$html .= '<div class="grid-sizer"></div>';
if ($rs && mysqli_num_rows($rs)) {
    while ($data_photo = mysqli_fetch_assoc($rs)) {
        $html .= '<div class="grid-item p-2 "><img  src="images/galerie_image/' . $data_photo['fichier'] . '" alt="' . $data_photo['alt'] . '" /></div>';
    }
}
$html .= '</div>';
$html .='</div>';
$html .= '<script src="https://masonry.desandro.com/masonry.pkgd.js"></script>';
$html .= '<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>';
$html .= '<script src="js/galerie.js"></script>';
