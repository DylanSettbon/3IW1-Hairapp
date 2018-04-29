function testForm(parentId,childId, elementTag, elementId){
    var html = '<form class="createCategoryPackage" action="saveCategoryPackage" method="post">'+
        'Catégorie:<br>'+
        '<input type="text" name="categorie">'+
        '<br><br>'+
        '<input type="submit" value="Submit">'+
        '</form> ';

    addElement(parentId,elementTag,elementId,html)
}

function addElement(parentId, elementTag, elementId, html) {
    var p = document.getElementById(parentId);
    var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerHTML = html;
    p.appendChild(newElement);
}


function addRow(elmt)
{
    var tr = document.createElement('tr');
    elmt.appendChild(tr);

    var td = document.createElement('td');
    tr.appendChild(td);
}