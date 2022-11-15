<?php
  

    // Gestion du retour du formulaire
    if(isset($_POST) && !empty($_POST)){
        $id_user = $_POST['id_user'];

        $h = array();
        $h['nom'] = $_POST['form_nom'];
        $h['prenom'] = $_POST['form_prenom'];

        // Gestion du Champs Mot de Passe
        if(!empty($_POST['form_password'])){
            $h['password'] = md5($_POST['form_password']);
        }
        $h['email'] = $_POST['form_email'];



        // Enregistrement en BDD des modifications
        if($id_user){
            // Update
            sql_simple_update('t_user',$id_user,$h);
        } else {
            // New
            $id_user = sql_simple_insert('t_user',$h);
        }

      

        // Redirection sur la page de modification de l'utilisateur (meme page mais avec id_user)
        header('location: index.php?page=connection&id='.$id_user);
    }
    //bloquer aux pas admin
    if (user_is_admin()) {
    
    if(isset($_GET['id'])) {
        // Modification
        $id_user = $_GET['id'];
        // Recuperation des informations depuis la BDD
        $sql = "SELECT * FROM t_user WHERE id=" . $id_user;
        $rs = query($sql);
        if($rs && mysqli_num_rows($rs))
            $data = mysqli_fetch_assoc($rs);
    }} else {
        // On est en Creation
        $id_user = 0;
        $data = array();
        $data['nom'] = '';
        $data['prenom'] = '';
        $data['email'] = '';
    }


    $html = '<div class="zone_contenu_clean">';

    // Formulaire de modification des informations de l'utilisateur
    $html.= '   <div class="form-style">';
    if($id_user > 0)
        $html.= '       <h1>Modification<span>Pour modifier l\'utilisateur, remplir ce formulaire...</span></h1>';
    else
        $html.= '       <h1>Nouvel Utilisateur<span>Pour créer l\'utilisateur, remplir ce formulaire...</span></h1>';

    // Formulaire de modification des information sur l'utilisateur
    $html.= '       <form method="POST" action="index.php?page=connection" enctype="multipart/form-data">';

    // Nom et Prénom
    $html.= '           <div class="section"><span>1</span>Nom et Prénom</div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>Nom <input type="text" name="form_nom" value="'.$data['nom'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>Prénom <input type="text" name="form_prenom" value="'.$data['prenom'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>e-mail <input type="email" name="form_email" value="'.$data['email'].'"/></label>';
    $html.= '           </div>';

  
    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>Mot de passe <input type="password" name="form_password" value=""/></label>';
    $html.= '           </div>';


    // Bouton Enregistrer
    $html.= '           <div class="button-section">';
    $html.= '               <input type="submit" name="Enregistrer" />';
    $html.= '           </div>';

    // Champs caché...
    $html.= '           <input type="hidden" name="id_user" id="id_user" value="'.$id_user.'" />';

    $html.= '       </form>';
    $html.= '   </div>';
    $html.= '</div>';

?>