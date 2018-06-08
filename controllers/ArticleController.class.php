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
         $v->assign("current", 'articleCategory');
        $article = new Article();
        $cat=$_GET['id'];
        $u= $article->getAllBy(["id" => $cat] , ["id,name,image, description,dateparution"], 2);
        $v->assign( "article", $u[0] );
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
    public function getArticleAdmin(){
        $v = new Views( "listeArticle", "admin_header" );
        $v->assign("current", 'users');
        $article = new Article();

        $a= $article->getUpdate("id=id ORDER BY dateparution DESC" , 2, "id, name , dateparution , description ");

        $v->assign( "a", $a );
    }

     
}
