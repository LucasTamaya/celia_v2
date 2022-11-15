<?php
$message_error = "";

// Test retour formulaire
if (isset($_POST) && !empty($_POST)) {
    // Verification login et mot de passe avec les données en BDD
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = 'SELECT * FROM t_user WHERE email="' . $email . '" LIMIT 1;';

    $rs = query($sql);

    if ($rs && mysqli_num_rows($rs)) {
        $data = mysqli_fetch_assoc($rs);
        if ($password == $data['password']) {
            // Enregistrement des informations en session
            $_SESSION[SESSION_NAME]['id_user'] = $data['id'];
            $_SESSION[SESSION_NAME]['nom_user'] = $data['prenom'] . ' ' . $data['nom'];
            $data_panier = array();
            $_SESSION[SESSION_NAME]['panier'] = $data_panier;
            header("location: index.php");
        } else {
            $message_error = '<p class="text-sm text-red-500">Email ou mot de passe incorrect</p>';
        }
    } else {
        $message_error = '<p class="text-sm text-red-500">Email ou mot de passe incorrect</p>';
    }
}

// formulaire de connexion
$html = '<div class="w-full h-[80vh] flex justify-center items-center">';
$html .= '  <div class="flex-1 max-w-[400px] mx-auto border-2 rounded p-5">';
$html .= '    <h1 class="text-2xl text-blue-900 font-semibold mb-3">Connexion</h1>';
$html .= '    <form class="flex flex-col gap-y-3" action="index.php?page=connection" method="POST" id="form_co" name="form_co">';
$html .= '        <input class="p-1 border rounded" type="text" name="email" id="email" placeholder="Email"/>';
$html .= '        <input class="p-1 border rounded" type="password" name="password" id="password" placeholder="Mot de passe"/>';
$html .= '        <button class="py-2 rounded text-white bg-blue-900" type="submit">Connexion</button>';
$html .= '    </form>';
$html .= '    <p class="text-sm">Pas encore de compte ? <a class="text-blue-500 underline" href="index.php?page=inscription">Inscription</a></p>';
$html .=      $message_error;
$html .= '  </div>';
$html .= '</div>';
