<body id="body-art">
  <style>

/* Center website */




/* Add padding BETWEEN each column */
.row,
.row > .column-articles {
    padding: 8px;
}

/* Create three equal columns that floats next to each other */
.column-articles {
    float: left;
    width: 33.33%;
    display: none; /* Hide all elements by default */
}

/* Clear floats after rows */ 


/* Content */
.content-articles {
    background-color: white;
    padding: 10px;
}

/* The "show" class is added to the filtered elements */
.show {
  display: block;
}

/* Style the buttons */
.btn-articles {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
}

.btnbtn-articles:hover {
  background-color: #ddd;
}

.btn-articles {
  background-color: #666;
  color: white;
}
</style>

  <main id="main-rdv" class="col-s-11 col-l-8 ">
        <div class="row">
            <h1 id="title-art" class="title col-s-12 col-m-12 col-l-12">Choisir une categorie</h1>
      </div>

     <!--<form method="get" action="<?php //echo DIRNAME; ?>category/getArticle/" >-->
      
        <div class="container-artcat liste-art" id="selectCategory" >
          <select name='category' class='input input_sign-in' onchange="filterSelection(this.value)">
              <option class="btn-articles" value="all">Tous</option>
               <?php
                    foreach($u as $category):
                            
                      echo"<option class='btn-articles' value=" . $category->getDescription(). ">". $category->getDescription() . "</option>";

                    endforeach;
                    ?>
          </select>
          <div class="row">
          <?php foreach ($a as $article): ?>
            <div style="padding:0 0.5vw;" class='col-s-12 col-m-6 col-l-6 column-articles <?php echo $article->getDescription_category(); ?>'>
              <div class="article-accueil content-articles" style="display: flex; flex-direction: column;">

                <div>
                  <?php if( !empty( $article->getImage() ) ): ?>
                      <img style="width: 100%;overflow: hidden;" src="<?php echo DIRNAME.$article->getImage();?>"/>
                  <?php else: ?>
                      <!-- image par defaut -->
                  <?php endif; ?>        
                </div>
                <div>
                    
                    <span>
                        <h3 class='titre-article'><?php echo $article->getName(); ?></h3>
                        <p class='content-art'>
                          <img class='' src='/public/img/quote.svg'/><?php echo $article->getMiniDescription(); ?> </p>
                    </span>
                    <a class='button-title' href="<?php echo DIRNAME; ?>article/getArticle/<?php echo $article->getId(); ?>">Voir plus...</a>

                </div>
               </div>   
             </div>  
            
          <?php endforeach; ?>
        </div>
        </div>
      

    <!--</form>-->




    <script type="text/javascript">
 //document.querySelector('select[name=category]').addEventListener('change', function() {
  //document.querySelector('form').submit();
//});
    </script>

    <script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column-articles");

  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
  }
}

function AddClass(element, name) {

  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("selectCategory");
var btns = btnContainer.getElementsByClassName("btn-articles");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
  });
}
</script>
  </main>
</body>
<?php include "templates/footer.tpl.php"; ?>
</html>
