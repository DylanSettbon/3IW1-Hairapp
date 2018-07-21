<body id="body-rdv">
<main>

    <article>
        <div class="container">
            <div class="row">

                <div class="col-s-12 col-m-6 col-l-6 center">
                    <div class="form_register" style="margin-bottom: 80px;">
                        <div class="row">
                            <h1 id="title-rdv" class="title col-l-10">Contactez-Nous</h1>

                        <?php

                        $this->addModal( "contactForm", $config, []); ?>

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
                            <ul class="errors col-l-12">

                                <li>
                                    <div class="div-errors success col-l-12">
                                        <p><strong> Success ! </strong><?php echo $success;?></p>
                                    </div>

                                </li>
                                <meta http-equiv="refresh" content="5;<?php echo DIRNAME ?>home/gethome">

                            </ul>
                        <?php endif; ?>

                        </div>
                        <hr>
                        <div class="row">
                            <?php if( !empty( $configuration->getPostalAddress() ) ): ?>


                                <div class="col-l-7">
                                    <h2>Adresse du salon : </h2>
                                </div>
                                <div class="col-l-5">

                                    <p><?php echo $configuration->getPostalAddress(); ?></p>

                                </div>
                            <?php endif; ?>
                        </div>
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