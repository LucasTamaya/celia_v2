<?php
require 'param/param.php';
require 'inc/framework.php';

session_name(SESSION_NAME);
session_start();

if (!empty($_GET['page']) && isset($page[$_GET['page']])) {
    $url_php = $page[$_GET['page']];
} else {
    $url_php = $page['accueil'];
}

$url_php_header = str_replace('.php', '_header.php', $url_php);

if (is_file($url_php_header)) {
    include $url_php_header;
}
?>
<html>

<head>
    <script src="https://kit.fontawesome.com/d19de467c5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    backgroundImage: {
                        'marbre': "url('./images/marbre_bg.png')",
                        'trait-or': "url('./images/traidoree.PNG')",
                        'cadre' : "url('./images/encadre.jpeg')",
                    }
                },
            },
        };
    </script>
    <?php
    // Gestion du fichier _head
    $url_php_head = str_replace('.php', '_head.php', $url_php);
    if (is_file($url_php_head)) {
        include $url_php_head;
    } else {
        echo '<title>' . $TITLE . '</title>';
    }
    ?>
</head>

<body>
    <?php
    require $url_php;
    ?>
</body>

</html>