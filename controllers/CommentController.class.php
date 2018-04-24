<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/04/2018
 * Time: 16:39
 */
class CommentController{
    public function addComment($params){
        $comment =new Comment();
        $form = $comment ->configFormAdd();

        $errors = [];


        if(!empty($params["POST"])){
            //Verification des saisies

            $errors = Validator::validate($form, $params["POST"]);

            if(empty($errors)){
                $comment->setContent($params["POST"]["content"]);
            }
        }

        $v = new Views("addComment", "header");
        $v->assign("config",$form);
        $v->assign("errors",$errors);


    }
}