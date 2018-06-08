<div class="container">
    <div class="row">
        <h1 class="title col-s-8 col-m-8 col-l-12">Articles</h1>
    </div>

   <?php foreach ($u as $article){
    echo "
    <div class='col-s-3 col-m-6 col-l-12 article-accueil'>
        <img class='img-art' src='../public/img/quote.svg'/>
            <span>
            
                <h3 class='titre-article'>".$article->getName()."</h3>
                  ";
                if($article->getImage()!=null){
                    echo "<img class='img-art' src='../public/img/".$article->getImage()."'/>";
                } echo "
                <p class='content-art'>".$article->getMiniDescription()."</p>
            </span>
            <a href='".DIRNAME."article/getArticle?id=".$article->getId()."'>Voir plus...</a>
            </div>";
            
     }?>       