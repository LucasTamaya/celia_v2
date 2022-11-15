<?php
    // mysql_   ==> Utilisation impossible
    // mysqli_  ==> Version procédurale  ==<
    // PDO      ==> Version  Object

    $die_message_serveur = '<div style="width:50vw;margin-top: 200px; height: 100px; margin: auto;line-height:100px;background-color: rgba(255,0,0,0.4);text-align:center;">Erreur Serveur</div>';
    $die_message_bdd = '<div style="width:50vw;margin-top: 200px; height: 100px; margin: auto;line-height:100px;background-color: rgba(255,0,0,0.4);text-align:center;">Erreur BDD</div>';;

    // Connexion au serveur
    $link = ($GLOBALS["___mysqli_ston"] = mysqli_connect($SERVEUR, $USER, $PASS)) or die($die_message_serveur);

    // Selection de la BDD
    mysqli_select_db($link, $DATABASE) or die($die_message_bdd);

    // Option : Gestion des accents
    $sql = "SET CHARACTER SET 'utf8mb4';";
    mysqli_query($link, $sql);

    $sql = "SET collation_connection = 'utf8mb4_general_ci';";
    mysqli_query($link, $sql);
?>