$(document).ready(function() {
    $('#burger').on('click', function() {
        //var li = $('.sidebar_buttons');
        //var navbar = $('.nav ul');
        //navbar.append( li );
        $('.nav').toggleClass('open');
    });
});

/*

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

*/