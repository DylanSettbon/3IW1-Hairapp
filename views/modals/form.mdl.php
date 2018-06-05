<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>">

    <?php foreach ($config["input"] as $name => $params):?>

        <?php if($params["type"] == "text" || $params["type"] == "email" || $params["type"] == "password" || $params["type"] == "tel"):?>

            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"


                    <?php if ( !empty( $vars ) && $params['type'] != "password"): ?>
                        <?php echo "value='" .$vars[$name] ."'" ; ?>
                    <?php else: ?>
                        <?php if( isset( $_POST[$name] ) ): ?>
                                <?php echo "value=".$_POST[$name]; ?>
                            <?php endif; ?>
                    <?php endif; ?>



                <?php echo (isset($params["required"]))?"required='required'":"";?>
            >

        <?php endif;?>


        <?php if( $params['type'] == 'checkbox' ):?>
            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    <?php if ( isset( $params['class'] ) ) :?>
                        class="<?php echo $params['class'];?>"
                    <?php endif; ?>
                    <?php if( !empty( $vars[$name] ) && $vars[$name] == 1 ): ?>
                        checked
                    <?php endif; ?>

            <?php if( isset( $params['span'] ) ):?>
                <span><?php echo $params["span"];?></span>
            <?php endif; ?>

        <?php endif; ?>

    <?php endforeach;?>

    <?php if( isset( $config['textarea'] ) ): ?>

        <?php foreach ( $config["textarea"] as $name => $params ):?>

            <textarea

                    name="<?php echo $name;?>"
                >
                <?php echo $params["placeholder"];?>

            </textarea>
        <?php endforeach;?>

    <?php endif; ?>

    <input type="submit" class="input center" id="valider" value="<?php echo $config["config"]["submit"];?>">

</form>