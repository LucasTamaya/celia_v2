<?php


// Gestion du retour du formulaire
if (isset($_POST) && !empty($_POST)) {
    $h = array();
    $h['nom'] = $_POST['form_nom'];
    $h['prenom'] = $_POST['form_prenom'];

    // Gestion du Champs Mot de Passe
    if (!empty($_POST['form_password'])) {
        $h['password'] = md5($_POST['form_password']);
    }
    $h['email'] = $_POST['form_email'];

    // enregistrement du nouvel utilisateur
    $id_user = sql_simple_insert('t_user', $h);

    // Redirection vers la page connexion
    header('location: index.php?page=connection');
}


$data = array();
$data['nom'] = '';
$data['prenom'] = '';
$data['email'] = '';

$html = '<div class="w-full h-[80vh] flex justify-center items-center">';
$html .= '  <div class="flex-1 max-w-[400px] mx-auto border-2 rounded p-5">';
$html .= '      <h1 class="text-2xl text-blue-900 font-semibold mb-3">Inscription</h1>';
$html .= '      <form class="flex flex-col gap-y-3" method="POST" action="index.php?page=inscription" enctype="multipart/form-data">';
$html .= '           <input class="p-1 border rounded" type="text" placeholder="Nom" name="form_nom" value="' . $data['nom'] . '"/>';
$html .= '           <input class="p-1 border rounded" type="text" placeholder="Prénom" name="form_prenom" value="' . $data['prenom'] . '"/>';
$html .= '           <input class="p-1 border rounded" type="email" placeholder="Email" name="form_email" value="' . $data['email'] . '"/>';
$html .= '           <input class="p-1 border rounded" type="password" placeholder="Mot de passe" name="form_password" value=""/>';
$html .= '           <button class="py-2 rounded text-white bg-blue-900" type="submit" name="">Enregistrer</button>';
$html .= '      </form>';
$html .= '    <p class="text-sm">Déjà un compte ? <a class="text-blue-500 underline" href="index.php?page=connection">Connection</a></p>';
$html .= '  </div>';
$html .= '</div>';
