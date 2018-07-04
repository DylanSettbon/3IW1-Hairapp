<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 24/04/2018
 * Time: 14:23
 */

class Pages extends BaseSql
{

    private $title;
    private $id;
    private $content;
    private $id_template;
    private $isNavbar;
    private $url;
    private $active;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {

        $content_post = $content;







        $this->content = $content;
    }


    /**
     * @return mixed
     */
    public function getisNavbar()
    {
        return $this->isNavbar;
    }

    /**
     * @param mixed $isNavbar
     */
    public function setIsNavbar($isNavbar)
    {
        $this->isNavbar = $isNavbar;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getIdTemplate()
    {
        return $this->id_template;
    }

    /**
     * @param mixed $id_template
     */
    public function setIdTemplate($id_template)
    {
        $this->id_template = $id_template;
    }



    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    public function joinContents( $contents = array() ){

        $final_content = "";
        $salt = "&@/==/@&";

        foreach ( $contents as $content ){
            $final_content .= $content . $salt;
        }

        return $final_content;
    }


    public function getTemplate( $template ){

        $content = '';

        switch ( $template ){
            case 1:
                $content =
                    '<div class="row">' .
                        '<div class="col-l-4">'
                            .'#@content1@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content2@#'.
                         '</div>' .
                        '<div class="col-l-4">'
                            .'#@content3@#'.
                        '</div>' .
                    '</div>

                     <div class="row">' .
                        '<div class="col-l-4">'
                            .'#@content4@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content5@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content6@#'.
                        '</div>
                     </div>';

                break;
            case 2:
                $content =
                    '<div class="row">' .
                        '<div class="col-l-4">'
                            .'#@content1@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content2@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content3@#'.
                        '</div>' .
                    '</div>

                     <div class="row">' .
                        '<div class="col-l-12">'
                            .'#@content4@#'.
                        '</div>
                     </div>';
                break;
            case 3:
                $content =
                    '<div class="row">' .
                        '<div class="col-l-12">'
                            .'#@content1@#'.
                        '</div>
                     </div>' .
                    '<div class="row">' .
                        '<div class="col-l-4">'
                            .'#@content2@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content3@#'.
                        '</div>' .
                        '<div class="col-l-4">'
                            .'#@content4@#'.
                        '</div>' .
                    '</div>';
                break;
            case 4:
                break;
            default:
                $content =
                    '<div class="row">' .
                    '<div class="col-l-4">'
                    .'#@content1@#'.
                    '</div>' .
                    '<div class="col-l-4">'
                    .'#@content2@#'.
                    '</div>' .
                    '<div class="col-l-4">'
                    .'#@content3@#'.
                    '</div>' .
                    '</div>

                     <div class="row">' .
                    '<div class="col-l-4">'
                    .'#@content4@#'.
                    '</div>' .
                    '<div class="col-l-4">'
                    .'#@content5@#'.
                    '</div>' .
                    '<div class="col-l-4">'
                    .'#@content6@#'.
                    '</div>
                     </div>';

                break;
        }

        return $content;
    }


}