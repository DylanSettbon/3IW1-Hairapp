$(document).ready(function() {
    $('#burger').on('click', function() {
        //var li = $('.sidebar_buttons');
        //var navbar = $('.nav ul');
        //navbar.append( li );
        $('.nav').toggleClass('open');
    });
});
