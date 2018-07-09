<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>" enctype="multipart/form-data">
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

     <?php if($params["type"] == "file"):?>

            <input 
             type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
            >
            <?php if( isset( $_POST[$name] ) ): ?>
            	<?php echo "value=".$_POST[$name]; ?>
            <?php endif; ?>
            <?php echo (isset($params["required"]))?"required='required'":"";?>

        <?php endif;?>

    <?php endforeach;?>

    <?php foreach ($config["textarea"] as $name => $params):?>

           <textarea 
           	name="<?php echo $name;?>" 
           	placeholder="<?php echo $params["placeholder"];?>"
           	rows = "<?php echo $params["rows"];?>"
           	cols = "<?php echo $params["cols"];?>"
           	class="<?php echo $params['class']; ?>"

            <?php echo (isset($params["required"]))?"required='required'":"";?>
           	>
           	
           </textarea>
           
    <?php endforeach;?>

    <?php foreach ($config["select"] as $name => $params):?>
    		<select
    			name = "<?php echo $name;?>"
    			class="<?php echo $params['class']; ?>">
    			<?php foreach ( $this->data['options'] as $option ):?>
    				<?php
    					echo "<option value='" . $option->getId() . "'>" .
    					$option->getDescription() . "</option>";?>
    			<?php endforeach; ?>
    		</select>
            

    <?php endforeach;?>

    <input type="submit" class="input center" id="valider" value="<?php echo $config["config"]["submit"];?>">

</form>