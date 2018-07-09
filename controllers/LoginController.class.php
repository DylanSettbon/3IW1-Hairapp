<?php
use PHPMailer\PHPMailer\PHPMailer;
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 25/03/2018
 * Time: 14:09
 */

class LoginController {



    /**
     * @return mixed
     */
    public function getLogin()
    {
        $user = new User();
        $form = $user->LoginForm();

        $v = new Views( "login", "header" );
        $v->assign("config", $form );
        $v->assign( "current", "login" );
    }


    /**
     * @internal param $login_
     * @internal param $mdp_
     */
    public function getVerify(){

        //Ca doit etre un objet
        $user = new User();
        $form = $user->LoginForm();
        //$errors = Validator::

        if( $_POST['email'] != '' ){

            $userInformations = $user->populate(
                array( "email" => $_POST['email'] )
            );

            if( empty( $userInformations) ){
                $errors[] = "L'utilisateur n'existe pas.";
            }
            else{
                $to_verify = array(
                    "email" => $userInformations->getEmail(),
                    "pwd" => $userInformations->getPwd()
                );

                $errors = Validator::login( $form, $to_verify );
            }


            if( empty( $errors ) ){
                $userInformations->setToken();
                //var_dump( $_POST ); die;
                $params = array(
                    "token" => $userInformations->getToken(),
                );
                //var_dump( $_POST ); die;
                $user->updateTable( $params, ["id" => $userInformations->getId()] );
                 $u=$user->getAllBy(["id" => $userInformations->getId()] , ["changetopwd"], 2);
                Security::setSession($userInformations);
                
                 if ($u[0]->getChangeToPwd() == 1 ){
                   header("Location: " . DIRNAME . "account/getChangeToPwd?id=". $userInformations->getId());

                }else {
                header("Location: " . DIRNAME . "home/getHome");
            }
        }
            else{
                $v = new Views( "login", "header" );
                $v->assign( "current", "login" );
                $v->assign("config",$form);
                $v->assign("errors",$errors);
            }


        }

    }

    /**
     * @param $email
     */
    public function forgetPwd(){
        $user = new User();
        $v = new Views("forgetPwd", "header");
        $form = $user->formForgetPwd();
        $v->assign("current", 'user');
        $v->assign("config", $form );
    }

    public function getNewPwd(){

    $user = new User();
    $v = new Views("forgetPwd", "header");
    $form = $user->formForgetPwd();
    $v->assign("current", 'user');
    $v->assign("config", $form );
    $user->setEmail(htmlentities($_POST['email']));
    $errors=Validator::validate($form,$_POST);
    $errorsUnique=Validator::isUnique($form,$_POST);

    if (empty($errors) && !empty($errorsUnique)){

        $u = $user->getAllBy(["email" => $user->getEmail()],["id, email,status"],2,''," HAVING status != -1");
        for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a{$x}, $i++);

        require("vendor/autoload.php");

             $mail = new PHPMailer();

                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                $mail->CharSet = 'UTF-8';
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465; //25 ou 465
                $mail->Username = 'notifications.hairapp@gmail.com' ;
                $mail->Password = 'zKXJKrMeGMH9';
                 $mail->From = 'notifications.hairapp@gmail.com';
                 $mail->FromName = 'notifications-hairapp';
                 $mail->IsHTML(true);
                 $mail->Subject = 'Mot de passe oublié';
                 $mail->Body = 'Voici votre nouveau mot de passe : '.$s.'<br>Un changement de mot de passe vous sera demander a la connexion';
                 $mail->AddAddress( $u[0]->getEmail() );
                 if(!$mail->Send()) {
                     $v->assign("errors", "Le mail n'a pas pu être envoyé !");
                 } else {
                    $v->assign("success","Un message vous a été envoyé !");
                 }
                 $user->setPwd( $s );
                 $user->updateTable(["changetopwd" => 1, "pwd" => $user->getPwd()],["id" => $u[0]->getId()]);
    }else {      
        $v->assign("errors",$errors);
    }   
    }

    public function logout(){
        session_destroy();
        header("Location:".DIRNAME."home/getHome");
    }
}