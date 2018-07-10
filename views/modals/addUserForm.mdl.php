<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>">

	<?php foreach ($config["input"] as $name => $params):?>

        <?php if($params["type"] == "text"):?>

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

         <?php if($params["type"] == "tel"):?>

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

   

    <?php foreach ($config["select"] as $name => $params):?>
    		<select
    			name = "<?php echo $name;?>"
    			class="<?php echo $params['class']; ?>">
    			<?php foreach ( $this->data['options'] as $option => $description ):?>
    				<?php
    					echo "<option value='" . $option. "'>" .
    					$description . "</option>";?>
    			<?php endforeach; ?>
    		</select>
            

    <?php endforeach;?>

    <input type="submit" class="input center" id="valider" value="<?php echo $config["config"]["submit"];?>">

</form>