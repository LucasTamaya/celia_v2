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

            header("location: index.php");
        } else {
            $message_error = '<p class="text-sm text-red-500">Email ou mot de passe incorrect</p>';
        }
    } else {
        $message_error = '<p class="text-sm text-red-500">Email ou mot de passe incorrect</p>';
    }
}

// formulaire de connexion
$html = '<div class="mt-28 max-w-[400px] mx-auto border-2 rounded p-5">';
$html .= '    <h1 class="text-3xl text-blue-900 font-semibold mb-5">Connexion</h1>';
$html .= '    <form action="index.php?page=connection" method="POST" id="form_co" name="form_co">';
$html .= '        <input class="w-full p-2 border rounded" type="text" name="email" id="email" placeholder="Email"/><br/><br/>';
$html .= '        <input class="w-full p-2 border rounded" type="password" name="password" id="password" placeholder="Mot de passe"/> <br/><br/>';
$html .= '        <button class="w-full py-2 rounded text-white bg-blue-900" type="submit">Connexion</button>';
$html .= '    </form>';
$html .=      $message_error;
$html .= '</div>';
