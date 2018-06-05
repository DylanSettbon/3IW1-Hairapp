<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:11
 */

class ArticleController  extends BaseSql {

    public function getArticle(){

        $v = new Views( "article", "header" );
    }

    public function addComment($params){
        $comment =new Comment();
        $user=new User();
        $comment->setIdUser($_SESSION['id']);
        $form = $comment ->configFormAdd();
        if(!empty($params["POST"])){
            //Verification des saisies

            $errors = Validator::validate($form, $params["POST"]);

            if(empty($errors)){
                $comment->setContent($params["POST"]["content"]);
            }
            $comment->save();
        }

        //$all =$comment->getUpdate("date;", 2, "*");
        //var_dump($all);die;
        $all =$comment->select("comment");
        //$firstname=$user->select("id LIKE ".$_SESSION['id'].";", 2,"firstname");
        $theUser=$user->select("user WHERE id like ".$_SESSION['id']." ;");
        $v = new Views("article", "header");
        $v->assign("config",$form);
        $v->assign("errors",$errors);
        $v->assign("all",$all);
        $v->assign("theUser", $theUser);


    }
}
