<?php
class Page
{
    private $header = '';
    private $footer = '';
    private $corps = '';

    // Constructeur
    public function __construct($show_interface = true)
    {
        if ($show_interface) {
            $this->build_header();
            $this->build_footer();
        } else {
            $this->header = '<body>';
            $this->footer = '</body>';
        }
    }

    public function build_content($html = '')
    {
        $this->corps = $html;
    }

    public function show()
    {
        echo $this->header;
        echo $this->corps;
        echo $this->footer;
    }

    // Header avec les liens de nos pages
    private function build_header()
    {
        $this->header = '<body>';
        $this->header .= '    <nav class="flex items-center justify-evenly bg-marbre bg-cover h-[10vh]">';

        if (user_is_admin()) {
            // Accueil
            $this->header .= '       <a class="text-white font-semibold" href="index.php">';
            $this->header .= '           Acceuil';
            $this->header .= '       </a>';

            // Page Prestations
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=prestations">';
            $this->header .= '           Prestations';
            $this->header .= '       </a>';

            // Page Galerie
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=galerie">';
            $this->header .= '           Galerie';
            $this->header .= '       </a>';
            // Page administration_produits
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=administration_prestations">';
            $this->header .= '           Ajouter une prestation';
            $this->header .= '       </a>';

            // Page listing_utilistateurs
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=listing_utilisateurs">';
            $this->header .= '           Listing Utilistateurs';
            $this->header .= '       </a>';

            // Page administration_photos
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=administration_galerie">';
            $this->header .= '           Administration galerie';
            $this->header .= '       </a>';

            // Page listing_prestations
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=listing_prestations">';
            $this->header .= '           Listing prestations';
            $this->header .= '       </a>';

            // Page listing_galerie
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=listing_galerie">';
            $this->header .= '           Listing Galerie Photo';
            $this->header .= '       </a>';
        } else {
            // Accueil
            $this->header .= '       <a class="text-white font-semibold" href="index.php">';
            $this->header .= '           Acceuil';
            $this->header .= '       </a>';

            // Page Prestations
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=prestations">';
            $this->header .= '           Prestations';
            $this->header .= '       </a>';

            // Page Galerie
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=galerie">';
            $this->header .= '           Galerie';
            $this->header .= '       </a>';
        }

        if (isset($_SESSION[SESSION_NAME]['id_user']) && !empty($_SESSION[SESSION_NAME]['id_user'])) {
            // Panier
            if (!user_is_admin()) {
                $this->header .= '   <a class="text-white font-semibold" href="index.php?page=panier">Panier</a></div>';
            }
            // Déconnexion
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=deconnection">Se Déconnecter</a></div>';
        } else {
            // Formulaire de connexion
            $this->header .= '       <a class="text-white font-semibold" href="index.php?page=connection">';
            $this->header .= '           Me connecter';
            $this->header .= '       </a>';
        }
        $this->header .= '    </nav>';
    }


    private function build_footer()
    {
        $this->footer .= '      <div class="bg-trait-or h-[0.5vh]"></div>';
        $this->footer .= '      <footer class="relative bottom-0 h-[9vh] flex items-center justify-evenly bg-marbre bg-cover w-full">';
        $this->footer .= '              <a class="text-white font-semibold" href="$">Mentions légales</a>';
        $this->footer .= '              <a class="text-white font-semibold" href="$">RGPD</a>';
        $this->footer .= '              <div class="flex items-center gap-x-5">';
        $this->footer .= '                  <a class="text-white font-semibold" href="$"><i class="fab fa-instagram text-3xl"></i></a>';
        $this->footer .= '                  <a class="text-white font-semibold" href="$"><i class="fab fa-facebook-square text-3xl"></i></a>';
        $this->footer .= '              <div>';
        $this->footer .= '      </footer>';
        $this->footer .= '</body>';
    }
}
