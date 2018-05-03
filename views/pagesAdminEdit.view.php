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
            echo"
            <div class='col-l-8 center' id='addPagesForm'>
                <form action='" . DIRNAME . "Admin/addPages' method='post'>
                    <input class='input' id='title' type='text' name='title' value ='" . $this->data['page_title'] ."' placeholder='Titre de la page' style='margin-bottom: 10px; '>

                    <textarea id='content' name='content' placeholder='content' style='width: 100%; height: 600px;'> "
                        . $this->data['page_content'] . "
                    </textarea>

                    <label>
                        <input class='addPageRadio' type='radio' name='isNavbar' ";

                            if( isset( $this->data['page_navbar'] ) && $this->data['page_navbar'] == 1 ){
                                echo "value ='" . $this->data['page_content']."' checked >Afficher dans la barre de navigation";
                            }
                            else{
                                echo "value='1' >Afficher dans la barre de navigation";
                            }

                    echo "
                    </label>
                    <label>
                        <input class='addPageRadio' type='radio' name='isNavbar' ";

                            if( isset( $this->data['page_navbar'] ) && $this->data['page_navbar'] == 0 ){
                                echo "value ='" . $this->data['page_content']."' checked >Ne pas afficher dans la barre de navigation";
                            }
                            else{
                                echo "value='0' >Ne pas afficher dans la barre de navigation";
                            }

                    echo "
                    </label>

                    <br>

                    <input class='input' id='url' name='url' placeholder='url de la page' type='text' ";

                            if( isset( $this->data['page_url'] ) ){
                                echo "value ='" . $this->data['page_url']."' >";
                            }
                            else{
                                echo "value='' >";
                            }
                    echo "<br>";

                        if( $this->data['modify'] ){
                            echo "<input type='text' name='isModify' hidden value=1> ";
                            echo "<input type='text' name='pageId' hidden value= " . $this->data['page_id'] ."> ";
                            echo "<input type='submit' id='sendPages' class='buttonUser' value='Engeristrer les modifications' >";

                        }
                        else{
                            echo " <input type='submit' id='sendPages' class='buttonUser' value='Créer la page' />";
                        }
                    ?>
                </form>
            </div>


        </div>
    </div>
</main>

<?php
include "templates/footer.tpl.php";
?>


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
            dropdownContent.style.display = "block";
        });
    }
</script>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({
        selector:'textarea',
        theme: 'modern',
        skin: 'lightgray',
        content_css: 'public.css/style.css'
    });</script>