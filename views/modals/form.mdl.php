<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>">

    <?php foreach ($config["input"] as $name => $params):?>

        <?php if($params["type"] == "text" || $params["type"] == "email" || $params["type"] == "password" || $params["type"] == "tel"):?>

            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
                    <?php echo ( isset( $_POST[$name] ) ) ? "value=".$_POST[$name]: ""; ?>
                <?php echo (isset($params["required"]))?"required='required'":"";?>
            >

        <?php endif;?>

        <?php if( $params['type'] == 'checkbox' ):?>
            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
            >
            <?php if( isset( $params['span'] ) ):?>
                <span><?php echo $params["span"];?></span>
            <?php endif; ?>

        <?php endif; ?>

    <?php endforeach;?>

    <?php foreach ( $config["textarea"] as $name => $params ):?>

        <textarea

                name="<?php echo $name;?>"
            >
            <?php echo $params["placeholder"];?>

        </textarea>
    <?php endforeach;?>

    <input type="submit" class="input center" id="valider" value="<?php echo $config["config"]["submit"];?>">

</form>