window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-121853212-1');



function toggleAnimated(x) {
    x.classList.toggle("change");
}


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