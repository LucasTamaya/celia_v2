<?php
if (user_is_admin()) {
    // Gestion de la suppression fichier
    if (isset($_GET['supp_produit'])) {
        // Suppression du produit
        $id_produit = $_GET['id'];

        // On recupere le nom du fichier a supprimer
        $produit = squery("SELECT fichier FROM t_produit WHERE id=" . $id_produit);

        // Suppression du fichier
        @unlink('pic/images/produits/' . $produit);

        // Update de la BDD
        $sql = "UPDATE t_produit SET fichier=NULL WHERE id=" . $id_produit;
        squery($sql);

        header("location: index.php?page=administration_prestations&id=" . $id_produit);
    }

    // Gestion du retour du formulaire
    if (isset($_POST) && !empty($_POST)) {
        $id_produit = $_POST['id_produit'];

        $h = array();
        $h['titre'] = $_POST['form_titre'];
        $h['prix'] = $_POST['form_prix'];
        $h['id_stripe'] = $_POST['form_stripe'];
        $h['description'] = $_POST['form_description'];
        $h['fk_categorie'] = $_POST['form_categorie'];
        $h['temps'] = $_POST['form_temps'];
        $h['ordre'] = squery('SELECT IFNULL(MAX(ordre) + 1,1) FROM t_produit');


        // Gestion de l'image produit
        if (isset($_FILES) && !empty($_FILES) && !empty($_FILES['my_file']['name'])) {
            // Generation d'un nom unique
            $tab_name = explode('.', $_FILES['my_file']['name']);
            $unique_name = uniqid('img_') . '.' . $tab_name[1];

            // Préparation de l'upload
            $target_file = 'images/produits/' . $unique_name;
            if (move_uploaded_file($_FILES['my_file']['tmp_name'], $target_file)) {
                require 'class/image.class.php';
                $mon_image = new Image($target_file);
                $mon_image->resize(255, 255);;
                $mon_image->store($target_file);

                $h['fichier'] = $unique_name;
            }
        }

        // Enregistrement en BDD des modifications
        if ($id_produit) {
            // Update
            sql_simple_update('t_produit', $id_produit, $h);
        } else {
            // New
            $id_produit = sql_simple_insert('t_produit', $h);
        }
        // Redirection sur la page de modification du produit (meme page mais avec id_produit)
        header('location: index.php?page=administration_prestations');
    }

    if (isset($_GET['id'])) {
        // Modification
        $id_produit = $_GET['id'];
        // Recuperation des informations depuis la BDD
        $sql = "SELECT * FROM t_produit WHERE id=" . $id_produit;
        $rs = query($sql);
        if ($rs && mysqli_num_rows($rs))
            $data = mysqli_fetch_assoc($rs);
    } else {
        // On est en Creation
        $id_produit = 0;
        $data = array();
        $data['titre'] = '';
        $data['fichier'] = '';
        $data['prix'] = '';
        $data['id_stripe'] = '';
        $data['description'] = '';
        $data['fk_categorie'] = '';
        $data['temps'] = '';
    }


    $html = '<div class="w-full h-[80vh] flex justify-center items-center" ">';
    $html .= '  <div class="flex-1 max-w-xl border-2 rounded p-5">';
    if ($id_produit)
        $html .= '       <h1 class="text-2xl text-blue-900 font-semibold mb-3">Modifier une prestation</h1>';
    else
        $html .= '       <h1 class="text-2xl text-blue-900 font-semibold mb-3">Ajouter une prestation</h1>';

    // Formulaire de modification des information sur l'utilisateur
    $html .= '       <form class="flex flex-col gap-y-3" method="POST" action="index.php?page=administration_prestations" enctype="multipart/form-data">';
    $html .= '           <input class="p-1 border rounded" placeholder="Titre" type="text" name="form_titre" value="' . $data['titre'] . '"/>';
    $html .= '           <input class="p-1 border rounded" placeholder="Description" type="text" name="form_description" value="' . $data['description'] . '"/>';
    $html .= '           <input class="p-1 border rounded" placeholder="Prix" type="number" name="form_prix" value="' . $data['prix'] . '"/>';
    $html .= '           <input class="p-1 border rounded" placeholder="Durée" type="number" name="form_temps" value="' . $data['temps'] . '"/>';
    $html .= '           <input class="p-1 border rounded" placeholder="ID stripe" type="text" name="form_stripe" value="' . $data['id_stripe'] . '"/>';
    $sql_categorie = "SELECT * FROM t_categorie ORDER BY nom ASC";
    $rs_categorie = query($sql_categorie);
    $html .= '            <select class="p-1 border rounded" name="form_categorie" id="form_categorie">';
    $html .= '                  <option value="0">Sélection categorie</option>';
    if ($rs_categorie && mysqli_num_rows($rs_categorie)) {
        while ($data_categorie = mysqli_fetch_assoc($rs_categorie)) {
            $html .= '           <option value="' . $data_categorie['id'] . '" ' . (($data['fk_categorie'] == $data_categorie['id']) ? ' selected ' : '') . '>' . $data_categorie['nom'] . '</option>';
        }
    }
    $html .= '             </select>';

    // fichier

    $html .= '            <input type="file" name="my_file"/>';
    if (is_file('images/produits/' . $data['fichier'])) {
        $html .= '               <a href="images/produits/' . $data['fichier'] . '" class="imageZoom"> voir image</a>';
        $html .= '               <a href="index.php?page=administration_prestations&id=' . $data['id'] . '&supp_produit=1" ">DELETE image</a>';
    }
    if ($id_produit)
        $html .= '       <button class="py-2 rounded text-white bg-blue-900" type="submit" name="Enregistrer">Modifier la prestation</button>';
    else
        $html .= '       <button class="py-2 rounded text-white bg-blue-900" type="submit" name="Enregistrer">Ajouter la prestation</button>';
    $html .= '           <input type="hidden" name="id_produit" id="id_produit" value="' . $id_produit . '" />';
    $html .= '       </form>';
    $html .= '   </div>';
    $html .= '</div>';
}
