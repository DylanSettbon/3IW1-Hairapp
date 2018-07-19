<?php

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
        $message->setMessage( $_POST['message'] );
        $users = new User();
        $users = $users->getAllBy(["status" => 3], ["id, email, status"], 2);
        $i=0;
        foreach ($users as $user):
            $to[$i] = $user->getEmail();
            $i++;
        endforeach;

                $from =$message->getEmail() ;
                $replyTo= [$message->getEmail()];
                $fromName = $message->getLastName();
                $object = $message->getObjet();
                $body =  'Message: '.$message->getMessage();
                $mail = new Mail($to, $from, $fromName, $object, $body, $replyTo, '', true);
                if(!$mail->Send()) {

                } else {
                    $this->getContact("Votre message a bien été envoyé");
                }
}
}