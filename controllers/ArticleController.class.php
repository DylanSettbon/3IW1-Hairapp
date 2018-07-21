<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:11
 */

class ArticleController  extends BaseSql {

    public function getArticle($params){
        
        $v = new Views( "article", "header" );
        $v->assign("current", 'articleCategory');
        $article = new Article();

        $comment =new Comment();
        $user=new User();
        $errors = [];

        $cat=$params['URL'][0];

        if( !empty( $_SESSION['id'] ) ){
            $comment->setIdUser($_SESSION['id']);
        }

        $comment->setIdArticle($cat);
        $form = $comment->configFormAdd();

        $u= $article->getAllBy(["id" => $cat] , ["id,name,image, description,dateparution"], 2);
        $month = array(
                    "01" => 'Janvier',
                    "02" => 'Février',
                    "03" => 'Mars',
                    "04" => 'Avril',
                    "05" => 'Mai',
                    "06" => 'Juin',
                    "07" => 'Juillet',
                    "08" => 'Août',
                    "09" => 'Septembre',
                    "10" => 'Octobre',
                    "11" => 'Novembre',
                    "12" => 'Décembre'
                );

        if(!empty($params["POST"])){
            $errors = Validator::validate($form, $params["POST"]);
            if(empty($errors)){
                $comment->setContent($params["POST"]["content"]);
            }
            $comment->save();
        }

        $comments =$comment->select("comment WHERE id_Article = '". $cat ."'");
        $users=$user->select("user");
        $v->assign("config",$form);
        $v->assign("errors",$errors);
        $v->assign("comments",$comments);
        $v->assign("users", $users);

#Voir sur internet pour recuperer hauter et largeur de l'image

        $v->assign( "article", $u[0] );
        $v->assign("month", $month);
    }

    public function addComment($params){

        $comment =new Comment();
        $user=new User();
        $cat=$_GET['id'];
        $comment->setIdUser($_SESSION['id']);
        $comment->setIdArticle($cat);
        $form = $comment->configFormAdd();



        if(!empty($params["POST"])){
            $errors = Validator::validate($form, $params["POST"]);

            if(empty($errors)){
                $comment->setContent($params["POST"]["content"]);
            }
            $comment->save();
        }

        $comments =$comment->select("comment WHERE id_Article = '". $cat ."'");
        $users=$user->select("user");
        $v->assign("config",$form);
        $v->assign("errors",$errors);
        $v->assign("comments",$comments);
        $v->assign("users", $users);
        $v->assign( "article", $u[0] );

    }
    
     
}
