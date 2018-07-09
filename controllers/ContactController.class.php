<?php

use PHPMailer\PHPMailer\PHPMailer;


class ContactController{

    public function getContact($options = null){

        $v = new Views( "contact", "header" );
        $v->assign( "current", "contact" );
        $message = new Message();
        $form = $message->formContact();
        $v->assign("config", $form);
        //var_dump($options);
        //option vide = 3 donc si different de 3 pas vide
        if (count($options) != 3){
            $v->assign("success", $options);
        } 

    }

    /**
     *
     */
    public function Validate( $params ){

        $message = new Message();
        $message->setLastname(htmlentities($_POST['nom']));
        $message->setEmail(htmlentities($_POST['email']));
        $message->setObjet(htmlentities( $_POST['objet'] ));
        $message->setMessage(htmlentities( $_POST['message'] ));
        
        

   require("vendor/autoload.php");

                $mail = new PHPMailer();

                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true;  // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465; //25 ou 465
                $mail->Username = 'notifications.hairapp@gmail.com' ;
                $mail->Password = 'zKXJKrMeGMH9';
                $mail->From =$message->getEmail();
                $mail->FromName = $message->getLastName();
                $mail->Subject = $message->getObjet();
                $mail->IsHTML(true);
                $mail->Body = 'Adresse mail: '.$message->getEmail().'<br>  Message: '.$message->getMessage();
                $mail->AddAddress( 'notifications.hairapp@gmail.com' );
                if(!$mail->Send()) {

                } else {
                    $this->getContact("Votre message a bien été envoyé");
                }
}
}