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
        <div class="packageContent-admin">

            <div class="container">
                <div class="row">
                    <div class="col-l-6">
                        <h1>Gestion de contenus : Pages</h1>
                    </div>

                    <div class="col-l-6" style="text-align: right">
                        <p><a href="getPagesAdmin">Retour</a></p>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col-l-7">
                        <h2>Sélectionnez le modèle de pages que vous souhaitez :</h2>
                    </div>
                </div>
                <div class="row" style="margin: 0 8px 5px 8px;">

                    <div class="container liste-templates">
                        <ul id="templates">
                            <li>
                                <input id="template1" type="checkbox" checked onclick="chooseTemplate('template1')">
                                <label for="template1" checked>
                                    <span class="nom-coiffeur">Template n°1</span>
                                </label>
                            </li>
                            <li>
                                <input id="template2" type="checkbox" onclick="chooseTemplate('template2')">
                                <label for="template2">
                                    <span class="nom-coiffeur">Template n°2</span>
                                </label>
                            </li>
                            <li>
                                <input id="template3" type="checkbox" onclick="chooseTemplate('template3')">
                                <label for="template3">
                                    <span class="nom-coiffeur">Template n°3</span>
                                </label>
                            </li>
                            <li>
                                <input id="template4" type="checkbox" onclick="chooseTemplate('template4')">
                                <label for="template4">
                                    <span class="nom-coiffeur">Template n°4</span>
                                </label>
                            </li>
                        </ul>

                    </div>

                </div>
            </div>


            <br>

            <div class='col-l-8 center' id='addPagesForm'>
                <form action='<?php echo DIRNAME . "Admin/addPages"; ?> method='post'>
                    <input class='input' id='title' type='text' name='title' value ='<?php $this->data['page_title']; ?>' placeholder='Titre de la page' style='margin-bottom: 10px; '>

                    <textarea id='content' name='content' placeholder='content' style='width: 100%; height: 600px;'>
                         <?php echo $this->data['page_content']; ?>
                    </textarea>

                <input type="text" id="template_choosen" hidden name="id_template" value="" />

                    <label>
                        <input class='addPageRadio' type='radio' name='isNavbar'

                            <?php if( isset( $this->data['page_navbar'] ) && $this->data['page_navbar'] == 1 ):
                                echo "value ='" . $this->data['page_navbar']."' checked >Afficher dans la barre de navigation";
                            else:
                                echo "value='1' >Afficher dans la barre de navigation";
                            endif; ?>


                    </label>
                    <label>
                        <input class='addPageRadio' type='radio' name='isNavbar' ";

                            <?php if( isset( $this->data['page_navbar'] ) && $this->data['page_navbar'] == 0 ):
                                echo "value ='" . $this->data['page_navbar']."' checked >Ne pas afficher dans la barre de navigation";
                            else:
                                echo "value='0' >Ne pas afficher dans la barre de navigation";
                            endif; ?>


                    </label>

                    <br>

                    <input class='input' id='url' name='url' placeholder='url de la page' type='text'

                            <?php if( isset( $this->data['page_url'] ) ):
                                echo "value ='" . $this->data['page_url']."' >";
                            else:
                                echo "value='' >";
                            endif; ?>
                    <br>

                        <?php if( $this->data['modify'] ):
                            echo "<input type='text' name='isModify' hidden value=1 > ";
                            echo "<input type='text' name='pageId' hidden value=" . $this->data['page_id'] ."> ";
                            echo "<input type='submit' id='sendPages' class='buttonUser' value='Engeristrer les modifications' >";

                        else:
                            echo " <input type='submit' id='sendPages' class='buttonUser' value='Créer la page' />";

                        endif; ?>
                </form>
            </div>


        </div>
    </div>
</main>


<script>
    $(function () { $('#title').keyup( function () { $('#url').val( $("#title").val().replace(/\s/g, "_")); }) } )</script>



<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=cv1iaiy59li07wxzo3ruuy3pmivhf4mwwrhr1cljdvgwwf03"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
        theme: 'modern',
        plugins: 'preview powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        image_advtab: true,
        content_css: [
            'http://localhost/3IW1-coiffeur/public/css/style.css'

        ],
        templates: [
            {title: 'Bloc 50%', description: 'Bloc d\'une largeur correspondant a 50% de l\'écran.' ,
                content: "<div class='col-l-6 col-s-6 col-m-6'> </div>"
            },
            {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'}
        ]
    });

</script>
<!--<script src='../public/ckeditor/ckeditor.js'></script>-->
<script>
    // Replace the <textarea id=\"editor1\"> with a CKEditor
    // instance, using default configuration.
    /*CKEDITOR.replace(
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


    );*/
</script>

<script>
    var Allpage = $('#content')[0];
    Allpage.append( 'okokokokokokokokokokokokokokoo');
    console.log( Allpage );
</script>

<script>
    $("input[id^='template']").click( function(){
        if( $(this).is(':checked') ) {
            $( "input[id^='template']" ).prop( "checked", false );

            $( this ).prop( "checked", true );
        }
    });


</script>

<script>
    function chooseTemplate( template ) {
        var template_checked = $("#" + template );
        var value = $("#template_choosen").val();
        //var value = input_template.val();
        //console.log( input_template );
        var Allpage = $('#content')[0];

       if( value == '' ){

           switch (template){
               case 'template1':
                   Allpage.append( "okokoko");
                   //Allpage.append( '<div class="row"><div class="col-l-4">1ere colonne</div><div class="col-l-4">1ere colonne</div><div class="col-l-4">1ere colonne</div></div><div class="row"><div class="col-l-4"></div><div class="col-l-4"></div><div class="col-l-4"></div></div>');
                   break;
               case 'template2':
                   break;
               case 'template3':
                   break;
               case 'template4':
                   break;
               default:
           }

           //Allpage.append( '<div');
           console.log( Allpage );
        }
    }
</script>

