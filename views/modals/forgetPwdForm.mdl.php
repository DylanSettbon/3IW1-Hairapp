<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>">

	<?php foreach ($config["input"] as $name => $params):?>

       
        <?php if($params["type"] == "email"):?>

            <input 
             type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
            
            <?php if( isset( $_POST[$name] ) ): ?>
            	<?php echo "value=".$_POST[$name]; ?>
            <?php endif; ?>
            <?php echo (isset($params["required"]))?"required='required'":"";?>
            >

        <?php endif;?>

    <?php endforeach;?>

   

    

    <input type="submit" class="input center" id="valider" value="<?php echo $config["config"]["submit"];?>">

</form>