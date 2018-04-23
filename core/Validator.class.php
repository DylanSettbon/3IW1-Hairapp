<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/04/2018
 * Time: 16:47
 */

class Validator
{

    public static function validate($form, $params)
    {
        $errorsMsg = [];

        foreach ($form["input"] as $name => $config) {

            if (isset($config["confirm"]) && $params[$name] !== $params[$config["confirm"]]) {
                $errorsMsg[] = $name . " doit être identique à " . $config["confirm"];
            } else if (!isset($config["confirm"])) {
                if ($config["type"] == "email" && !self::checkEmail($params[$name])) {

                    $errorsMsg[] = "L'email n'est pas valide";

                } else if ($config["type"] == "password" && !self::checkPwd($params[$name])) {
                    $errorsMsg[] = "Le mot de passe est incorrect (6 à 12, min, maj, chiffres)";
                }

            }


            if (isset($config["required"]) && !self::minLength($params[$name], 1)) {
                $errorsMsg[] = $name . " doit faire plus de 1 caractère";
            }

            if (isset($config["minString"]) && !self::minLength($params[$name], $config["minString"])) {
                $errorsMsg[] = $name . " doit faire plus de " . $config["minString"] . " caractères";
            }

            if (isset($config["maxString"]) && !self::maxLength($params[$name], $config["maxString"])) {
                $errorsMsg[] = $name . " doit faire moins de " . $config["maxString"] . " caractères";
            }

        }

        return $errorsMsg;
    }
}