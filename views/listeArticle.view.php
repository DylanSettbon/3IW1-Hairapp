
    <div>
        <article class="arriere_plan">

            <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

                <div class="col-l-4">
                    <h2 class="center title"> Gestion des articles</h2>
                </div>

            </div>

            <div class="col-s-12 col-l-12 col-m-9 tab-admin">
                <table class="userManagerTab col-l-12">
                    <tr>
                        
                        <th >Nom Article</th>
                        <th >Date</th>
                        <th >Description</th>
                        
                        

                    </tr>
                    <?php   
                    
                            foreach ($a as $article) {

                                
                                echo "
                                 <tr>
                                    <td> ".  $article->getName() . " 
                                    </td>
                                    <td> ".  $article->getDateParution() . " 
                                    </td>
                                    <td> ".  $article->getDescription() . " 
                                    </td>
                                    
                                </tr>
                                ";
                            }
                    
                    ?>
                    
                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="3">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                        </tr>
                       
                    </nav>
                </table>
                
            </div>
        </article>
    </div>

  </main>
