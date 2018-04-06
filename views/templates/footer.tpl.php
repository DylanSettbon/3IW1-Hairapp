<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/02/2018
 * Time: 14:22
 */
?>
    <footer class="footer">
        ©Hair'App
    </footer>
<script>
    function toggleAnimated(x) {
        x.classList.toggle("change");
    }
</script>

<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("sidebar_ul");
    var btns = header.getElementsByClassName("li-navbar");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            console.log( current );
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>

    <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script type="text/javascript" src="../public/js/index.js"></script>
    </body>

</html>
