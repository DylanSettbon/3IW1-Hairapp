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

        var dropdown = document.getElementsByClassName("dropdown");

        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active", true);
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
        console.log( dropdown );
    </script>

    </body>

</html>
