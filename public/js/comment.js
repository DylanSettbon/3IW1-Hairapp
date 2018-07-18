$("input[id^='valider']").click( function(){
    $idArticle = $('select[name=article]').val()
    document.listArticle.action += $idArticle;
});