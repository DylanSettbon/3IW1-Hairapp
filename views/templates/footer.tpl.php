<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 04/02/2018
 * Time: 14:22
 */
?>
<footer>
    <div class="footer">
        ©Hair'App
        <script type="text/javascript" src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
        <script type="text/javascript" src="../public/js/index.js"></script>
    </div>
</footer>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121853212-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-121853212-1');
</script>

    <script src=" <?php echo DIRNAME; ?>public/js/index.js"></script>

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

    <script>
        function hairdresser( id ) {

            if( id === 1 ){
                $(".coiffeur-1").show();
                $(".coiffeur-2").hide();
                $(".coiffeur-3").hide();
            }
            else if( id === 2 ){
                $(".coiffeur-1").hide();
                $(".coiffeur-2").show();
                $(".coiffeur-3").hide();
            }
            else if( id === 3 ){
                $(".coiffeur-1").hide();
                $(".coiffeur-2").hide();
                $(".coiffeur-3").show();
            }
            else if( id === 'all' ){
                $(".coiffeur-1").show();
                $(".coiffeur-2").show();
                $(".coiffeur-3").show();
            }



        }
    </script>

    </body>

</html>
