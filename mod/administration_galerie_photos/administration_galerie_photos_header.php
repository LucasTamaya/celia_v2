<?php

$html_result = '';

// Verification si retour d'un formulaire $_POST
if (isset($_POST)  && !empty($_POST)) {
    // Etape 1. Gestion du fichier uploader

    // Etape 1.1. Test si fichier saisi par l'utilisateur
    if (isset($_FILES) && !empty($_FILES)) {
        // Etape 1.2. Génération d'un nom de fichier unique
        $tab_name = explode('.', $_FILES['form_file']['name']);
        $unique_name = uniqid('img_') . '.' . $tab_name[count($tab_name) - 1];

        // Etape 1.3. Vérification de l'extension du fichier
        if (!preg_match('/\.(jpg|gif|png|jpeg)$/', $_FILES['form_file']['name'])) {
            $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
            $html_result .= '    Erreur ! Type fichier non supporté...<br/>';
            $html_result .= '</div>';
        } else {
            // Etape 1.4. Selection du repertoire et chemin du fichier uploadé
            $target_file = 'images/galerie_image/' . $unique_name;

            // Etape 1.5. Gestion réel de l'upload
            if (move_uploaded_file($_FILES['form_file']['tmp_name'], $target_file)) {

                $html_result = '<div class="result_form_ok" id="result_form_ok" onclick="document.getElementById(\'result_form_ok\').remove();">';
                $html_result .= '    Image uploadé ! <br/>';
                $html_result .= '    <img src="' . $target_file . '" style="width:80%;margin:auto; margin-top:50px;margin-bottom:50px;"/>';
                $html_result .= '</div>';

                // Enregistrer les informations en BDD !
                $h = array();
                $h['alt'] = $_POST['form_alt'];
                $h['fichier'] = $unique_name;
                $h['ordre'] = squery('SELECT IFNULL(MAX(ordre) + 1,1) FROM t_photo');
                sql_simple_insert('t_photo', $h);
            } else {
                //Erreur Upload
                $html_result = '<div class="result_form_ko" id="result_form_ko" onclick="document.getElementById(\'result_form_ko\').remove();">';
                $html_result .= '    Erreur Upload !<br/>';
                $html_result .= '</div>';
            }
        }
    }
}

$html = '<div>';
$html .= '       <h1 class="text-center text-2xl font-semibold my-5">Pour la galerie photo</h1>';

// Formulaire de modification des information sur la galerie photo
$html .= '       <form class="flex flex-col gap-y-3 max-w-2xl mx-auto" method="POST" action="index.php?page=administration_photos" enctype="multipart/form-data">';

// champs a remplir
$html .= '           <div>';
$html .= '              <label>Texte alternatif</label>';
$html .= '              <input class="w-full block border rounded p-1" type="text" name="form_alt" value=""/>';
$html .= '           </div>';

$html .= '           <div>';
$html .= '              <label>Image</label>';
$html .= '              <input class="w-full block rounded p-1" type="file" name="form_file"/>';
$html .= '           </div>';

// Résultat Upload
// $html .= '           <div class="section"><span>2</span>Informations Upload</div>';
// $html .= '           <div class="inner-wrap">';
// $html .= '               ' . $html_result;
// $html .= '           </div>';


$html .= '           <button class="text-white p-2 bg-blue-900 rounded">Ajouter la photo</button>';


$html .= '       </form>';
$html .= '   </div>';
$html .= '</div>';
