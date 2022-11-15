<?php
    $message_error = "";

    // Test retour formulaire
    if(isset($_POST) && !empty($_POST)){
        // Verification login et mot de passe avec les données en BDD
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql='SELECT * FROM t_user WHERE email="'.$email.'" LIMIT 1;';
       
        $rs = query($sql);

        if($rs && mysqli_num_rows($rs)){
            $data = mysqli_fetch_assoc($rs);
            if($password == $data['password']){
                // Enregistrement des informations en session
                $_SESSION[SESSION_NAME]['id_user'] = $data['id'];
                $_SESSION[SESSION_NAME]['nom_user'] = $data['prenom'].' '.$data['nom'];

                header("location: index.php");
            }else{
                $message_error = '<div>Mot de passe incorrect !</div>';
            }
        }else{
            $message_error = '<div>email Introuvable</div>';
        }



        // Seconde methode (plus sécurisé mais moins ergonomique pour l'utilisateur
        /*$sql = "SELECT * FROM t_user WHERE login='".$login."' AND password='".$password."' LIMIT 1;";
        $rs = query($sql);
        if($rs && mysqli_num_rows($rs)){
            // Login OK
            $data = mysqli_fetch_assoc($rs);
            $_SESSION[SESSION_NAME]['id_user'] = $data['id'];
            $_SESSION[SESSION_NAME]['nom_user'] = $data['prenom'].' '.$data['nom'];
            $_SESSION[SESSION_NAME]['avatar'] = 'pic/upload/avatar/'.$data['avatar'];

            header("location: index.php");
        }else{
            // Login KO
            $message_error = '<div class="login_ko">Login impossible</div>';
        }*/


    }

    // Creation du formulaire de connexion
    $html = '<div>';
    $html.= '    <h1>Connexion</h1>';
    $html.= '    <form action="index.php?page=login" method="POST" id="form_co" name="form_co">';
    $html.= '        <br/>';
    $html.= '        <input type="text" name="email" id="email" placeholder="email"/><br/><br/>';
    $html.= '        <input type="password" name="password" id="password" placeholder="Password"/> <br/><br/>';
    $html.= '        <input type="submit"/>';
    $html.= '    </form>';
    $html.= '</div>';
    $html.= $message_error;

?>
