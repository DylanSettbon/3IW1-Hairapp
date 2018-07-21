<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/02/2018
 * Time: 14:22
 */
?>

<footer>
    <div class="row footer">
        <div class="col-l-6">
            <p>©Hair'App</p>
        </div>
        <div class="col-l-6 social">
            <?php if( isset( $configuration ) ): ?>
                <?php if( !empty( $configuration->getFacebookLink() ) ): ?>
                    <a href="<?php echo $configuration->getFacebookLink();?>" target="_blank" class="fa fa-facebook"></a>

                <?php endif; ?>
                <?php if( !empty( $configuration->getTwitterLink() ) ): ?>
                    <a href="<?php echo $configuration->getTwitterLink() ;?>" target="_blank" class="fa fa-twitter"></a>

                <?php endif; ?>
                <?php if( !empty( $configuration->getInstagramLink() ) ): ?>
                    <a href="<?php echo $configuration->getInstagramLink() ;?>" target="_blank" class="fa fa-instagram"></a>

                <?php endif; ?>
                <?php if( !empty( $configuration->getPinterestLink() ) ): ?>
                    <a href="<?php echo $configuration->getPinterestLink();?>" target="_blank" class="fa fa-pinterest"></a>

                <?php endif; ?>
            <?php endif; ?>
        </div>
        <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
        <script type="text/javascript" src="<?php echo DIRNAME;?>public/js/index.js"></script>



    </div>
</footer>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121853212-1"></script>
<script src="<?php echo DIRNAME . "public/js/admin.js";?> ">

</script>


    </body>

</html>
