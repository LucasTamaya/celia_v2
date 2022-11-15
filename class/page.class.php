<?php
    class Page{
        private $header = '';
        private $footer = '';
        private $corps = '';

        // Constructeur
        public function __construct($show_interface=true){
            if($show_interface) {
                $this->build_header();
                $this->build_footer();
            }else{
                $this->header = '<body>';
                $this->footer = '</body>';
            }
        }

        public function build_content($html=''){
            $this->corps = $html;
        }

        public function show(){
            echo $this->header;
            echo $this->corps;
            echo $this->footer;
        }
        private function build_header()
        {
            $this->header = '<body>';
            $this->header .= '    <nav class="flex justify-evenly bg-blue-900 p-5">';
    
            if (user_is_admin()) {
                // Page administration_produits
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=administration_produits">';
                $this->header .= '           Administration Produit';
                $this->header .= '       </a>';
    
                // Page administration_photos
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=administration_photos">';
                $this->header .= '           Administration Photo';
                $this->header .= '       </a>';
    
                // Page listing_produit
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=listing_produits">';
                $this->header .= '           Listing produit';
                $this->header .= '       </a>';

                // Page listing_utilisateur 
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=listing_user">';
                $this->header .= '           Listing user';
                $this->header .= '       </a>';

            } else {
                // Accueil
                $this->header .= '       <a class="text-white font-semibold" href="index.php">';
                $this->header .= '           Acceuil';
                $this->header .= '       </a>';
    
                // Page Galerie
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=galerie_photo">';
                $this->header .= '           Galerie photo';
                $this->header .= '       </a>';
    
                // Page Prestations
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=prestation">';
                $this->header .= '           Prestation';
                $this->header .= '       </a>';
    
                // Formulaire de connexion
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=login">';
                $this->header .= '           Me connecter';
                $this->header .= '       </a>';
                // Page inscription et modification utilisateur 
                $this->header .= '       <a class="text-white font-semibold" href="index.php?page=connection">';
                $this->header .= '           inscription';
                $this->header .= '       </a>';
            }
            $this->header .= '    </nav>';
            if(isset($_SESSION[SESSION_NAME]['id_user']) && !empty($_SESSION[SESSION_NAME]['id_user'])){
                $this->header.= '<div> ma session ===>      '.$_SESSION[SESSION_NAME]['nom_user'].'';
                $this->header.= '       <a href="index.php?page=logout">Deconnection</a></div>';
                }
        }



        private function build_footer(){
            $this->footer = '    </div>';
            $this->footer.= '    <div id="html_footer"> ';
          // $this->footer.= '       '.$_SESSION[SESSION_NAME]['nom_user'].'<br/>';
         //  $this->footer.= '       <a href="index.php?page=logout">se deconnecter</a>';
            $this->footer.= '    </div>';
            $this->footer.= '</body>';
        }

    }
?>