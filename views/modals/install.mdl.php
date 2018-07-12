<form method="<?php echo $config["config"]["method"]?>"
      action="<?php echo DIRNAME . $config["config"]["action"]?>"
      id="<?php echo $config["config"]["id"];?>" >

    <?php foreach ( $config["div"] as $groups => $params ):?>

        <div class=<?php echo $params['class'];?>><?php echo $params['steps'];?>

            <?php foreach ( $params['input'] as $nameIpt => $paramsIpt ): ?>
                <p>
                    <?php if($paramsIpt["type"] == "text" || $paramsIpt["type"] == "email" || $paramsIpt["type"] == "password" || $paramsIpt["type"] == "tel"):?>

                        <input
                            type="<?php echo $paramsIpt["type"];?>"
                            class="<?php echo $paramsIpt['class'];?>"
                            placeholder="<?php echo $paramsIpt['placeholder'];?>"
                            oninput="this.className = ''"
                            name="<?php echo $nameIpt;?>"
                    <?php endif; ?>

                    <?php if( $paramsIpt["type"] == "time" ): ?>
                        <label for="<?php echo $paramsIpt['id'];?>"><?php echo $paramsIpt['placeholder'];?></label>
                        <input
                            type="<?php echo $paramsIpt["type"];?>"
                            class="<?php echo $paramsIpt['class'];?>"
                            id="<?php echo $paramsIpt['id'];?>"
                            oninput="this.className = ''"
                            name="<?php echo $nameIpt;?>"
                    <?php endif; ?>

                    <?php if( isset( $_POST[$nameIpt] ) ): ?>
                        <?php echo "value=".$_POST[$nameIpt]; ?>
                    <?php endif; ?>
                    >

                </p>

            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>