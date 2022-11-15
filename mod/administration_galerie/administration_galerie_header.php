<?php
$html = "";
if (user_is_admin()) {
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
                $html_result .= '<p class="text-red-500">Erreur ! Type fichier non supporté...<p/>';
            } else {
                // Etape 1.4. Selection du repertoire et chemin du fichier uploadé
                $target_file = 'images/galerie_image/' . $unique_name;

                // Etape 1.5. Gestion réel de l'upload
                if (move_uploaded_file($_FILES['form_file']['tmp_name'], $target_file)) {
                    $html_result .= '<p class="text-green-500">Image correctement ajouté à la galerie !</p>';
                    // Enregistrer les informations en BDD !
                    $h = array();
                    $h['alt'] = $_POST['form_alt'];
                    $h['fichier'] = $unique_name;
                    $h['ordre'] = squery('SELECT IFNULL(MAX(ordre) + 1,1) FROM t_photo');
                    sql_simple_insert('t_photo', $h);
                } else {
                    //Erreur Upload
                    $html_result .= '<p class="text-red-500">Erreur Upload !</p>';
                }
            }
        }
    }

    $html = '<div class="w-full h-[80vh] flex justify-center items-center" ">';
    $html .= '  <div class="flex-1 max-w-xl border-2 rounded p-5">';
    $html .= '       <h1 class="text-2xl text-blue-900 font-semibold mb-3">Ajouter une image à la galerie</h1>';
    $html .= '       <form class="flex flex-col gap-y-3" method="POST" action="index.php?page=administration_galerie" enctype="multipart/form-data">';
    $html .= '           <input class="p-1 border rounded" type="text" placeholder="Texte alternatif" name="form_alt" value="" />';
    $html .= '           <input type="file" name="form_file"/>';
    $html .= '           <div class="inner-wrap">';
    $html .= '           </div>';
    $html .= '               <button class="py-2 rounded text-white bg-blue-900" type="submit" name="Enregistrer">Ajouter</button>';
    $html .= '       </form>';
    $html .= '       ' . $html_result;
    $html .= '   </div>';
    $html .= '</div>';
}
