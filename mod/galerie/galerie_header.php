
<?php
if( isset($_GET['id_suppr'])  && !empty($_GET['id_suppr'])){
    $id_suppr = $_GET['id_suppr'];

    // Recuperer le nom de l'image
    $image = squery("SELECT fichier FROM t_photo WHERE id=".$id_suppr);

    // Supprimer l'enregistrement en BDD
    sql_simple_delete('t_photo',$id_suppr);

    // Supprimer le fichier sur le disque
    @unlink('images/galerie_image/'.$image);

    // Redirection
    header('location: index.php?page=galerie_photo');
}



    $html="";
    // Requete SQL
$sql = 'SELECT * FROM t_photo ORDER BY id DESC';

// Execution requete
$rs = query($sql);

$html.='<h1> Bienvenu dans ma galerie photo </h1>';

if($rs && mysqli_num_rows($rs)){
    
   
    while($data_photo = mysqli_fetch_assoc($rs)){

        
        $html.= '<a onclick="if(window.confirm(\'Etes vous sur ?\')) return true; else return false;" href="index.php?page=galerie_photo&id_suppr='.$data_photo['id'].'"><img src="images/galerie_image/'.$data_photo['fichier'].'" alt="'.$data_photo['alt'].'" /></a>';
        
    }
   
}

?>
<script src="js/js.js"></script>
