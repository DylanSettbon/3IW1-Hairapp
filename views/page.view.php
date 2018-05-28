<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 26/04/2018
 * Time: 22:52
 */



foreach ( $this->data['navbar'] as $content ){

    if( $content->getUrl() == $this->data['data']['URL']  ){
        echo "
        <main class='container'>
            <div>
                " . $content->getContent() . "
            </div>
        </main>
        ";
    }

}