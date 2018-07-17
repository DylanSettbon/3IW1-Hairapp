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
        $cat=$params['URL'][0];
        $u= $article->getAllBy(["id" => $cat] , ["id,name,image, description,dateparution"], 2);

#Voir sur internet pour recuperer hauter et largeur de l'image

        # definir une hauteur max et largeur max
        # si largeur image > Largeur_max => $v->assign( "oversize", "1" );
        # $ratio = hauteur de l'image divisé par hauteur MAX => 1.25
        # tu dois te retrouver avce ratio = 75%
        # $v->assign( "ratio", $ratio );

        $v->assign( "article", $u[0] );
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

        #Voir sur internet pour recuperer hauter et largeur de l'image
        
                # definir une hauteur max et largeur max
                # si largeur image > Largeur_max => $v->assign( "oversize", "1" );
                # $ratio = hauteur de l'image divisé par hauteur MAX => 1.25
                # tu dois te retrouver avce ratio = 75%
                # $v->assign( "ratio", $ratio );        
        

        $u= $article->getAllBy(["id" => $cat] , ["id,name,image, description,dateparution"], 2);
        $comments =$comment->select("comment WHERE id_Article = '". $cat ."'");
        $users=$user->select("user");
        $v->assign("config",$form);
        $v->assign("errors",$errors);
        $v->assign("comments",$comments);
        $v->assign("users", $users);
        $v->assign("article", $u[0]);

    }
    
     
}
