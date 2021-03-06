<form method="<?php echo $config["config"]["method"]?>" action="<?php echo DIRNAME.$config["config"]["action"]?>" class="col-l-12">


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


            <?php echo (isset($params["disable"]))?"disabled":"";?>
            <?php echo (isset($params["required"]))?"required='required'":"";?>
            <?php echo (isset($params["hidden"]))?"hidden":"";?>

            <?php if ( isset( $params['referer'] ) ): ?>
                value="<?php echo parse_url($_SERVER["HTTP_REFERER"])["path"]?>"
            <?php endif;?>
        >

    <?php endif;?>

    <?php endforeach; ?>

    <input type="submit" class="input center valider" value="<?php echo $config["config"]["submit"];?>">
</form>