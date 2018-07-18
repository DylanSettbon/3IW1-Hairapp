
<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:17
 */

class Views
{
    private $v;
    private $t;
    private $f;
    private $data = [];

    public function __construct($v = "index",$t = "header", $f = "footer" ){
        $this->v = $v.".view.php";
        $this->t = $t.".tpl.php";
        $this->f = $f.".tpl.php";

        if( !file_exists("views/templates/".$this->t)){
            die("Le template ".$this->t." n'existe pas");
        }
        if( !file_exists("views/".$this->v)){
            die("La vue ".$this->v." n'existe pas");
        }
        if( !file_exists("views/templates/".$this->f)){
            die("Le footer ".$this->f." n'existe pas");
        }

    }

    public function assign( $key , $value){

        $this->data[$key] = $value;
    }

    public function addModal($modal, $config, $errors=[], $vars = []){

        include "views/modals/".$modal.".mdl.php";

    }

    public function __destruct(){
        global $a, $c;

        $navbar = new Pages();
        $vues = $navbar->getAllBy(
            [
                "isNavbar" => 1
            ], null, 3
        );

        $conf = new Configuration();
        $logo = $conf->getAllBy(
            [
                "status_configuration" => 1
            ],
            [
                "logo, facebook_link, twitter_link, instagram_link, pinterest_link"
            ], 3
        );

        if( !empty( $logo ) ){
            $this->assign("logo", $logo[0]->getLogo() );
            $this->assign("facebook", $logo[0]->getFacebookLink() );
            $this->assign("twitter", $logo[0]->getTwitterLink() );
            $this->assign("instagram", $logo[0]->getInstagramLink() );
            $this->assign("pinterest", $logo[0]->getPinterestLink() );
        }

        foreach ( $vues as $vue ) {

            $template = $navbar->getTemplate( $vue->getIdTemplate() );

            $contents_bdd = explode( '&@/==/@&', $vue->getContent() );

            $count = count( $contents_bdd );
            unset( $contents_bdd[$count - 1 ] ) ;
            $count -= 1;

            $contents = array();

            for( $i = 0; $i < $count; $i++ ){
                $j = $i + 1;
                $contents['content'.$j] = $contents_bdd[$i];
            }

            foreach ( $contents as $content => $value ){

                $template = str_replace( "#@".$content."@#", $value, $template );
                $vue->setContent ( $template );

            }
        }

        $this->assign( 'navbar', $vues);
        extract($this->data);

        include "views/templates/".$this->t;
    }

}
