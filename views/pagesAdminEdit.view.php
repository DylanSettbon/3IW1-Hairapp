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

            <div class="col-l-6">
                <h1>Gestion de contenus : Pages</h1>
            </div>

            <div class="col-l-6" style="text-align: right">
                <p><a href="getPagesAdmin">Retour</a></p>
            </div>

            <?php
            echo"
            <div class='col-l-8 center' id='addPagesForm'>
                <form action='" . DIRNAME . "Admin/addPages' method='post'>
                    <input class='input' id='title' type='text' name='title' value ='" . $this->data['page_title'] ."' placeholder='Titre de la page' style='margin-bottom: 10px; '>

                    <textarea id='content' name='content' placeholder='content' style='width: 100%; height: 600px;'>" .
                         $this->data['page_content'] . "
                    </textarea>

                    <label>
                        <input class='addPageRadio' type='radio' name='isNavbar' ";

                            if( isset( $this->data['page_navbar'] ) && $this->data['page_navbar'] == 1 ){
                                echo "value ='" . $this->data['page_navbar']."' checked >Afficher dans la barre de navigation";
                            }
                            else{
                                echo "value='1' >Afficher dans la barre de navigation";
                            }

                    echo "
                    </label>
                    <label>
                        <input class='addPageRadio' type='radio' name='isNavbar' ";

                            if( isset( $this->data['page_navbar'] ) && $this->data['page_navbar'] == 0 ){
                                echo "value ='" . $this->data['page_navbar']."' checked >Ne pas afficher dans la barre de navigation";
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
                            echo "<input type='text' name='isModify' hidden value=1 > ";
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

<!--

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=cv1iaiy59li07wxzo3ruuy3pmivhf4mwwrhr1cljdvgwwf03"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        language: "fr_FR",
        height: 500,
        theme: 'modern',
        plugins: 'preview powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        content_css: [
            'http://localhost/public/css/style.css'

        ],
        templates: [
            {title: 'Bloc 50%', description: 'Bloc d\'une largeur correspondant a 50% de l\'écran.' ,
                content: "<div class='col-l-6 col-s-6 col-m-6'> </div>"
            },
            {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
        ]
    });

</script>
-->
<script src='../public/ckeditor/ckeditor.js'></script>


<script>
    // Replace the <textarea id=\"editor1\"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace(
        'content',{
            language: 'fr',
            contentsCss: '../public/css/style.css',
            toolbarGroups: [
                { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'forms' },
                { name: 'tools' },
                { name: 'document',       groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'others' },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                { name: 'styles' },
                { name: 'colors' },
                { name: 'about' }
            ]
        }


    );
</script>

