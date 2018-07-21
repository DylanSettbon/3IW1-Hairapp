<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 16/05/2018
 * Time: 17:47
 */

class ErrorsController{


    public function get404(){
        header("HTTP/1.0 404 Not Found");
        $v = new Views( "errors/404", "header");
        $v->assign("current", '');
        //http_response_code(404);
        
    }

    public function get403(){
        header("HTTP/1.0 403 Forbidden access");
        $v = new Views( "errors/403", "header");
        $v->assign("current", '');
        //http_response_code(404);
        header("HTTP/1.0 403 Forbidden access");
    }

    public function get401(){
        header("HTTP/1.0 401 Unauthorized");
        $v = new Views( "errors/401", "header");
        $v->assign("current", '');
        
    }
}