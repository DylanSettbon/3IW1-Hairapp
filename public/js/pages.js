function chooseTemplate( template ) {

    var value = $("#template_choosen");
    var divContent = $("#content2");
    var contentsSaved = $('.contentHidden');

    var saveContent = [];
    var j = 0;

    console.log( contentsSaved.length );
    if( contentsSaved.length > 0 ){
        for( var i = 0; i < contentsSaved.length; i++ ){

            saveContent[j] = contentsSaved[i];
            j++;
        }

        switch (template){
            case 'template1':
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content1" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[0].innerHTML +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content2" placeholder="content" style="width: 100%; height: 100px;"> ' +
                    saveContent[1].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content3" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[2].innerHTML+
                    '                    </textarea></div>' +
                    '</div><div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content4" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[3].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content5" placeholder="content" style="width: 100%; height: 100px;"> ' +
                    saveContent[4].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content6" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[5].innerHTML+
                    '                    </textarea></div></div>';
                value.attr("value", 1);
                break;
            case 'template2':
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-4">' +
                    '<textarea class="ckeditor" name="content1" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[0].innerHTML +
                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content2" placeholder="content" style="width: 100%; height: 100px;"> ' +
                    saveContent[1].innerHTML +
                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content3" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[2].innerHTML +
                    '        </textarea>' +
                    '     </div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-l-12">' +
                    '        <textarea class="ckeditor" name="content4" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[3].innerHTML +
                    '        </textarea>' +
                    '    </div>' +
                    '</div>';
                value.attr("value", 2);
                break;
            case 'template3':
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-12">' +
                    '        <textarea class="ckeditor" name="content1" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[0].innerHTML +
                    '        </textarea>' +
                    '    </div>' +
                    '</div>'+
                    '<div class="row">' +
                    '<div class="col-l-4">' +
                    '<textarea class="ckeditor" name="content2" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[1].innerHTML +
                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content3" placeholder="content" style="width: 100%; height: 100px;"> ' +
                    saveContent[2].innerHTML +
                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content4" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[3].innerHTML +
                    '        </textarea>' +
                    '     </div>' +
                    '</div>';
                value.attr("value", 3);
                break;
            case 'template4':
                break;
            default:
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[0].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;"> ' +
                    saveContent[1].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[2].innerHTML +
                    '                    </textarea></div>' +
                    '</div><div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[3].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;"> ' +
                    saveContent[4].innerHTML +
                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +
                    saveContent[5].innerHTML +
                    '                    </textarea></div></div>';
        }


    }
    else{

        switch (template){
            case 'template1':
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content1" placeholder="content" style="width: 100%; height: 100px;">' +


                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content2" placeholder="content" style="width: 100%; height: 100px;"> ' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content3" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div>' +
                    '</div><div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content4" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content5" placeholder="content" style="width: 100%; height: 100px;"> ' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content6" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div></div>';
                value.attr("value", 1);
                break;
            case 'template2':
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-4">' +
                    '<textarea class="ckeditor" name="content1" placeholder="content" style="width: 100%; height: 100px;">' +

                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content2" placeholder="content" style="width: 100%; height: 100px;"> ' +

                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content3" placeholder="content" style="width: 100%; height: 100px;">' +

                    '        </textarea>' +
                    '     </div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-l-12">' +
                    '        <textarea class="ckeditor" name="content4" placeholder="content" style="width: 100%; height: 100px;">' +

                    '        </textarea>' +
                    '    </div>' +
                    '</div>';
                value.attr("value", 2);
                break;
            case 'template3':
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-12">' +
                    '        <textarea class="ckeditor" name="content1" placeholder="content" style="width: 100%; height: 100px;">' +

                    '        </textarea>' +
                    '    </div>' +
                    '</div>'+
                    '<div class="row">' +
                    '<div class="col-l-4">' +
                    '<textarea class="ckeditor" name="content2" placeholder="content" style="width: 100%; height: 100px;">' +

                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content3" placeholder="content" style="width: 100%; height: 100px;"> ' +

                    '        </textarea>' +
                    '    </div>' +
                    '<div class="col-l-4">' +
                    '        <textarea class="ckeditor" name="content4" placeholder="content" style="width: 100%; height: 100px;">' +

                    '        </textarea>' +
                    '     </div>' +
                    '</div>';
                value.attr("value", 3);
                break;
            case 'template4':
                break;
            default:
                divContent[0].innerHTML =
                    '<div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;"> ' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div>' +
                    '</div><div class="row">' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;"> ' +

                    '                    </textarea></div>' +
                    '<div class="col-l-4"><textarea class="ckeditor" name="content" placeholder="content" style="width: 100%; height: 100px;">' +

                    '                    </textarea></div></div>';
        }
    }




    CKEDITOR.replaceAll( 'ckeditor', {
        language: 'fr',
        bodyId: "contentPage",
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
    });
}


window.onload = chooseTemplate( 'template1' );