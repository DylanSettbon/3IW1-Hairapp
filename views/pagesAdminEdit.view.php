<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 24/04/2018
 * Time: 16:29
 */

include "templates/sidebar.view.php";

?>



<main class='container'>
    <div class="content">
        <div class="col-s-12 col-l-12 col-m-9 packageContent-admin">

            <h1>Gestion de contenus : Pages</h1>

            <?php
            echo "okokokokokok";
            ?>


            <div class="col-l-8 center" id="addPagesForm">
                <form action="<?php echo DIRNAME;?>Admin/addPages" method="post" >
                    <input class="input" id="title" type="text" name="title" placeholder="Titre de la page" style="margin-bottom: 10px; ">

                    <textarea name="content" placeholder="content" style="width: 100%; height: 600px;"></textarea>

                    <label>
                        <input class="addPageRadio" type="radio" name="isNavbar" value="1">
                        Afficher dans la barre de navigation
                    </label>
                    <label>
                        <input class="addPageRadio" type="radio" name="isNavbar" value="0" checked>
                        Ne pas afficher dans la barre de navigation
                    </label>

                    <br>

                    <input class="input" id="url" name="url" placeholder="url de la page" value="" type="text">

                    <br>
                    <input type="submit" id="sendPages" class="buttonUser" value="Créer la page" />
                </form>
            </div>


        </div>
    </div>
</main>

<?php
include "templates/footer.tpl.php";
?>


<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea', theme: 'modern', skin: 'lightgray'});</script>


<script>
    $(function () { $('#title').keyup( function () { $('#url').val( $("#title").val().replace(/\s/g, "_")); }) } )
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
</script>