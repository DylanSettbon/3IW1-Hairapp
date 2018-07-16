<form method="<?php echo $config["config"]["method"]?>" action="<?php echo $config["config"]["action"]?>" class="<?php echo $config["config"]["class"]; ?>">

    <h2 <?php echo isset($config["h2"]["class"])?'class="'.$config["h2"]["class"] .'"':''; ?>><?php echo $config["h2"]["value"]?></h2>

    <hr>

    <?php foreach ($config["input"] as $name => $params):?>
            <?php if(isset($params["label"])):?>
                <label><?php echo $params["label"]["text"]; ?></label>
            <?php endif;?>

            <input
                <?php if(isset($params["id"])): ?>
                    id="<?php echo $params["id"]; ?>"
                <?php endif; ?>
                type="<?php echo $params["type"];?>"
                name="<?php echo $name;?>"
                <?php if(isset($params["class"])): ?>
                    class="<?php echo $params["class"]; ?>"
                <?php endif; ?>
                <?php if(isset($params["placeholder"])): ?>
                    placeholder="<?php echo $params["placeholder"]; ?>"
                <?php endif; ?>
                <?php echo (isset($params["required"]))?"required='required'":"";?>
                <?php if(isset($params["value"])): ?>
                    value="<?php echo $params["value"]; ?>"
                <?php endif; ?>
           >
    <?php endforeach;?>
</form>