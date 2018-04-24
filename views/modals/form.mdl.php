<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>">

    <?php foreach ($config["input"] as $name => $params):?>

        <?php if($params["type"] == "text" || $params["type"] == "email" || $params["type"] == "password"):?>

            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    placeholder="<?php echo $params["placeholder"];?>"
                <?php echo (isset($params["required"]))?"required='required'":"";?>
            ><br>

        <?php endif;?>

    <?php endforeach;?>

    <input type="submit" value="<?php echo $config["config"]["submit"];?>">

</form>