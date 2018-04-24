<?php
/**
 * Created by PhpStorm.
 * User: antoine
<<<<<<< HEAD
 * Date: 04/02/2018
 * Time: 11:27
 */
?>
<main class='container'>
        <div class="content">
            <div class="col-s-12 col-l-12 col-m-9 packageContent-admin">

                <h1>Gestion de contenus</h1>
                <div class="row">
                    <input method="post" class="btnCreatePackage col-l-3" type="button" onclick ="testForm('package_content','3','div','contentManagerTest')" value="Ajouter une nouvelle catégorie">
                </div>
                    <p></p>
                <div id="package_content">

                </div>
            </div>
        </div>

<script>

    function testForm(parentId,childId, elementTag, elementId){
        var html = '<form action="saveCategoryPackage" method="post">'+
                    'Catégorie:<br>'+
                    '<input type="text" name="categorie">'+
                    '<br><br>'+
                    '<input type="submit" value="Submit">'+
                    '</form> ';

        addElement(parentId,elementTag,elementId,html)
    }

    function addNewPackageCategory(parentId,childId, elementTag, elementId) {
        var html = '<table id="contentManager'+ childId +'" class="contentManagerTab col-l-6">'+
                '<caption class="category-title">Coiffure homme</caption>'+
                '<tr>'+
                    '<th id="desc'+ childId +'">Description</th>'+
                    '<th id="price'+ childId +'">Prix</th>'+
                    '<th id="modify'+childId+'">Modifier</th>'+
                    '<th id="delete'+childId+'">Supprimer</a></th>'+
                '<tr>'+
                '<td>Coupe homme</td>' +
                '<td>10</td>'+
                '<td><input type="button" class="buttonUpdatePackage" value="Modifier"></td>' +
                '<td><input id="checkBox" type="checkbox"></td>'+
                '</tr>'+
            '</table>'

        addElement(parentId,elementTag,elementId,html)
    }

    function addElement(parentId, elementTag, elementId, html) {
        var p = document.getElementById(parentId);
        var newElement = document.createElement(elementTag);
        newElement.setAttribute('id', elementId);
        newElement.innerHTML = html;
        p.appendChild(newElement);
    }
</script>
    <?php
    include 'templates/footer.tpl.php';
    echo "
    <div class='sidenav'>
      <ul>
          <a href= '" . DIRNAME ."admin/getAdmin'>LOGO</a>
          <li class='active sidebar_buttons'><a href='" . DIRNAME ." '>Categories</a></li>
          <li class='sidebar_buttons'><a href='" . DIRNAME . "admin/getUserAdmin'>Pages</a></li>
          <li class='sidebar_buttons'><a href='". DIRNAME . "admin/getContentAdmin'>articles</a></li>
      </ul>
    </div> ";
    ?>
</main>

