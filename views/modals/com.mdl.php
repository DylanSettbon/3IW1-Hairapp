<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>">

    <?php foreach ($config["input"] as $name => $params):?>

        <?php if($params["type"] == "text" || $params["type"] == "email" || $params["type"] == "password"):?>

            <textarea rows="4" cols="40"
                    style="margin:15px;"
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    placeholder="<?php echo $params["placeholder"];?>"
                <?php echo (isset($params["required"]))?"required='required'":"";?>
            ></textarea><br>

        <?php endif;?>

    <?php endforeach;?>

    <input class="buttonUser" type="submit" value="<?php echo $config["config"]["submit"];?>">

</form>
