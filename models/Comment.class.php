<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 08/04/2018
 * Time: 21:01
 */

class Comment extends BaseSql
{
    protected $id=null;
    protected $content;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
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
        $this->content = $content;
    }
    public function configFormAdd(){

        return [
            "config"=>["method"=>"POST", "action"=>"", "submit"=>"Commenter"],
            "input"=>[

                "content"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre commentaire",
                    "required"=>true,
                    "minString"=>2,
                    "maxString"=>400
                ]

            ]
        ];
    }

}