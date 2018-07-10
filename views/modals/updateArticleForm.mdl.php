<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>" enctype="multipart/form-data">


    <?php foreach ($config["input"] as $name => $params):?>
         <?php if($params["type"] == "hidden"):?>

            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    value="<?php echo $vars['article'][$name]; ?>"

                    
                        <?php if( isset( $_POST[$name] ) ): ?>
                                <?php echo "value=".$_POST[$name]; ?>
                            <?php endif; ?>

                <?php echo (isset($params["required"]))?"required='required'":"";?>
            >

        <?php endif;?>

        <?php if($params["type"] == "file"):?>

            <?php if( !empty( $vars['article'][$name] ) ):?>
                <img src="<?php echo DIRNAME.$vars['article'][$name]; ?>"
                    style="height: 100px; width: 100px;"
                >
            <?php endif; ?>

            <input 
             type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
                    value="<?php echo DIRNAME.$vars['article'][$name]; ?>"
            >
            <?php if( isset( $_POST[$name] ) ): ?>
                <?php echo "value=".DIRNAME."public/img/a_p/".$_POST[$name]; ?>
            <?php endif; ?>
            <?php echo (isset($params["required"]))?"required='required'":"";?>



        <?php endif;?>

        <?php if($params["type"] == "text"):?>

            <input
                    type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
                    value="<?php echo $vars['article'][$name]; ?>"

                    
                        <?php if( isset( $_POST[$name] ) ): ?>
                                <?php echo "value=".$_POST[$name]; ?>
                            <?php endif; ?>

                <?php echo (isset($params["required"]))?"required='required'":"";?>
            >

        <?php endif;?>


         <?php if($params["type"] == "date"):?>

            <input 
             type="<?php echo $params["type"];?>"
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
                    value="<?php echo $vars['article'][$name]; ?>"
            >
            <?php if( isset( $_POST[$name] ) ): ?>
                <?php echo "value=".$_POST[$name]; ?>
            <?php endif; ?>
            <?php echo (isset($params["required"]))?"required='required'":"";?>

        <?php endif;?>


    <?php endforeach;?>

     <?php foreach ($config["textarea"] as $name => $params):?>

           <?php if($params["type"] == "textarea"):?>

            <textarea
            
                    name="<?php echo $name;?>"
                    class="<?php echo $params['class']; ?>"
                    placeholder="<?php echo $params["placeholder"];?>"
            <?php echo (isset($params["required"]))?"required='required'":"";?>
            >
                <?php echo $vars['article'][$name]; ?>
            </textarea>
            <?php if( isset( $_POST[$name] ) ): ?>
                <?php echo "value=".$_POST[$name]; ?>
            <?php endif; ?>
            
           
        <?php endif;?>

    <?php endforeach;?>
    
    <?php foreach ($config["select"] as $name => $params):?>
            <select
                name = "<?php echo $name;?>"
                class="<?php echo $params['class']; ?>">
                <?php foreach ( $vars['options'] as $option => $description ):?>
                    <option 
                        value='<?php echo $description->getId();?>' 
                        <?php if ( $description->getId() == $vars['article'][$name] ):?>
                            selected
                        <?php endif; ?>
                    >
                        <?php echo $description->getDescription() ?>

                    </option>


                    
                        
                <?php endforeach; ?>
            </select>
            

    <?php endforeach;?>

    <input type="submit" class="input center" id="valider" value="<?php echo $config["config"]["submit"];?>">

</form>