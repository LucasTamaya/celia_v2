<?php
     $html = "";
     if (user_is_admin()) {
       // Gestion de la suppression fichier
       if(isset($_GET['supp_produit'])){
        // Suppression du produit
        $id_produit = $_GET['id'];

        // On recupere le nom du fichier a supprimer
        $produit = squery("SELECT fichier FROM t_produit WHERE id=".$id_produit);

        // Suppression du fichier
        @unlink('pic/images/produits/'.$produit);

        // Update de la BDD
        $sql = "UPDATE t_produit SET fichier=NULL WHERE id=".$id_produit;
        squery($sql);

        header("location: index.php?page=administration_prestations&id=".$id_produit);
    }

    // Gestion du retour du formulaire
    if(isset($_POST) && !empty($_POST)){
        $id_produit = $_POST['id_produit'];

        $h = array();
        $h['titre'] = $_POST['form_titre'];
        $h['prix'] = $_POST['form_prix'];
        $h['description'] = $_POST['form_description'];
        $h['fk_categorie'] = $_POST['form_categorie'];
        $h['temps'] = $_POST['form_temps'];
        $h['ordre'] = squery('SELECT IFNULL(MAX(ordre) + 1,1) FROM t_produit');
        

        // Gestion de l'image produit
        if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['my_file']['name'])){
            // Generation d'un nom unique
            $tab_name = explode('.',$_FILES['my_file']['name']);
            $unique_name = uniqid('img_').'.'.$tab_name[1];

            // Préparation de l'upload
            $target_file = 'images/produits/' . $unique_name;
            if (move_uploaded_file($_FILES['my_file']['tmp_name'], $target_file)) {
                require 'class/image.class.php';
                $mon_image = new Image($target_file);
                $mon_image->resize(255,255);;
                $mon_image->store($target_file);

                $h['fichier'] = $unique_name;
            }
        }

        // Enregistrement en BDD des modifications
        if($id_produit){
            // Update
            sql_simple_update('t_produit',$id_produit,$h);
        } else {
            // New
            $id_produit = sql_simple_insert('t_produit',$h);
        }


        // Redirection sur la page de modification du produit (meme page mais avec id_produit)
        header('location: index.php?page=administration_prestations&id='.$id_produit);
    }

    if(isset($_GET['id'])) {
        // Modification
        $id_produit = $_GET['id'];
        // Recuperation des informations depuis la BDD
        $sql = "SELECT * FROM t_produit WHERE id=" . $id_produit;
        $rs = query($sql);
        if($rs && mysqli_num_rows($rs))
            $data = mysqli_fetch_assoc($rs);
    } else {
        // On est en Creation
        $id_produit = 0;
        $data = array();
        $data['titre'] = '';
        $data['fichier'] = '';
        $data['prix'] = '';
        $data['description'] = '';
        $data['fk_categorie'] = '';
        $data['temps'] = '';
    }


    $html .= '<div class="zone_contenu_clean">';

    // Formulaire de modification des informations de l'utilisateur
    $html.= '   <div class="form-style">';
    if($id_produit > 0)
        $html.= '       <h1>Modification<span>Pour modifier le produit, remplir ce formulaire...</span></h1>';
    else
        $html.= '       <h1>Nouvel Utilisateur<span>Pour créer le produit, remplir ce formulaire...</span></h1>';

    // Formulaire de modification des information sur l'utilisateur
    $html.= '       <form method="POST" action="index.php?page=administration_prestations" enctype="multipart/form-data">';

    // Nom et Prénom
    $html.= '           <div class="section"><span>1</span>titre et description</div>';
    $html.= '           <div class="inner-wrap-l">';
    $html.= '               <label>titre <input type="text" name="form_titre" value="'.$data['titre'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>description <input type="text" name="form_description" value="'.$data['description'].'"/></label>';
    $html.= '           </div>';
    $html.= '           <div style="clear:both;"></div>';

    // Information Connexion
    $html.= '           <div class="section"><span>2</span>prix et temps</div>';
    $html.= '               <label>prix <input type="number" name="form_prix" value="'.$data['prix'].'"/></label>';
    $html.= '               <label>temps <input type="number" name="form_temps" value="'.$data['temps'].'"/></label>';
    //$html.= '               <label>ordre <input type="number" name="form_ordre" value="'.$data['ordre'].'"/></label>';
    
    $html.= '           </div>';


    // Adresse
    $html.= '               <label>categorie';
    $sql_categorie = "SELECT * FROM t_categorie ORDER BY nom ASC";
    $rs_categorie = query($sql_categorie);
    $html.= '                   <select name="form_categorie" id="form_categorie">';
    $html.= '                       <option value="0">Sélection categorie</option>';
    if($rs_categorie && mysqli_num_rows($rs_categorie)){
        while($data_categorie = mysqli_fetch_assoc($rs_categorie)){
            $html.= '                   <option value="'.$data_categorie['id'].'" '.(($data['fk_categorie'] == $data_categorie['id'])?' selected ':'').'>'.$data_categorie['nom'].'</option>';
        }

    }
    $html.= '                   </select>';
    $html.= '               </label>';


    // fichier

    $html.= '           <div class="inner-wrap-r">';
    $html.= '               <label>fichier image du produit <input type="file" name="my_file"/>';
    if(is_file('images/produits/'.$data['fichier'])){
        $html.= '               <a href="images/produits/'.$data['fichier'].'" class="imageZoom"> voir image</a>';
        $html.= '               <a href="index.php?page=administration_prestations&id='.$data['id'].'&supp_produit=1" ">DELETE image</a>';
    }
    $html.= '               </label>';
    $html.= '           </div>';

    $html.= '           <div style="clear:both;"></div>';

   

    // Bouton Enregistrer
    $html.= '           <div class="button-section">';
    $html.= '               <input type="submit" name="Enregistrer" />';
    $html.= '           </div>';

    // Champs caché...
    $html.= '           <input type="hidden" name="id_produit" id="id_produit" value="'.$id_produit.'" />';

    $html.= '       </form>';
    $html.= '   </div>';
    $html.= '</div>';
}
