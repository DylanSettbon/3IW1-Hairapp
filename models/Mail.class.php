<?php
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
require("vendor/autoload.php");

class Mail extends PHPMailer {
    public function __construct($to,$from,$fromName,$object,$body,$replyTo = null,$replyToName = null,$automatic = null)
    {
        parent::__construct();
        if ($automatic){
            $body .= '<br><br>--------------------------------------------------------------<br>
            Ceci est un mail automatique, Merci de ne pas y répondre.';
        }
        $this->IsSMTP(); // enable SMTP
        $this->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $this->SMTPAuth = true;  // authentication enabled
        $this->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $this->Host = 'smtp.gmail.com';
        $this->Port = 465; //25 ou 465
        $this->Username = 'notifications.hairapp@gmail.com' ;
        $this->Password = 'zKXJKrMeGMH9';
        $this->CharSet = 'UTF-8';
        $this->IsHTML(true);
        $this->setFrom($from ,$fromName);
        foreach($to as $t) {
            $this->AddAddress($t);
        }
        $this->Subject = $object;
        $this->Body = $body;
        if(!empty($replyTo)) {
            foreach ($replyTo as $r) {
                $this->addReplyTo($r, $replyToName);
            }
        }
    }
}