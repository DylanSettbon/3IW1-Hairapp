
<style>
    #loader span{
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 100%;
        background-color: #3498db;
        margin: 35px 5px;
        opacity: 0;
    }

    #loader span:nth-child(1){
        animation: opacitychange 1s ease-in-out infinite;
    }

    #loader span:nth-child(2){
        animation: opacitychange 1s ease-in-out 0.33s infinite;
    }

    #loader span:nth-child(3){
        animation: opacitychange 1s ease-in-out 0.66s infinite;
    }

    @keyframes opacitychange{
        0%, 100%{
            opacity: 0;
        }

        60%{
            opacity: 1;
        }
    }
</style>

<div class="container">

    <div class="row">
        <div class="col-l-6 center">
            <h1>Bienvenue sur l'installateur</h1>
        </div>

    </div>
    <div class="row" id="secondPart">
        <?php $this->addModal("install", $config ); ?>
        <div class="col-l-6 center">
            <?php if( isset( $errors ) ): ?>
                <ul class="errors">

                    <?php foreach ( $errors as $error ): ?>
                        <li>
                            <div class="div-errors danger">
                                <p><strong> Warning ! </strong><?php echo $error;?></p>
                            </div>

                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if( isset( $success ) ): ?>
            <ul class="errors">
                <li>
                    <div class="div-errors success">
                        <p><strong> Success ! </strong><?php echo $success;?></p>
                        <meta http-equiv="refresh" content="5;<?php echo DIRNAME ?>home/gethome">
                    </div>

                </li>
            </ul>
            <?php endif; ?>

            <?php if( isset( $loading ) ): ?>
                <?php if( $loading == true ): ?>
                    <div class="loader" id="loader">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>


    </div>

</div>


<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the crurrent tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("configForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
