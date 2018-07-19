<body id="body-rdv">
    <main>

        <article>
            <div class="container">
                <div class="row">

                    <div class="col-s-12 col-m-6 col-l-6 center">
                        <div class="form_register">
                            <div class="row">
                                <h1 id="title-rdv" class="title col-l-12">Modifier l'article</h1>
                            </div>
                            <?php
                             $this->addModal( "updateArticleForm", $config, [], $options ); ?>
                            <ul class="errors">
                    <?php if( isset( $errors ) ): ?>
                        <?php foreach ( $errors as $error ): ?>
                            <li>
                                <div class="div-errors danger">
                                    <p><strong> Warning ! </strong><?php echo $error;?></p>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
</body>

<script src='<?php echo DIRNAME ."public/ckeditor/ckeditor.js"; ?> '></script>
<script type="text/javascript">
    CKEDITOR.replaceAll( 'ckeditor', {
            language: 'fr',
            bodyId: "contentPage",
            contentsCss: 'public/css/style.css',
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
        });
</script>


<?php
    include "templates/footer.tpl.php";
?>
