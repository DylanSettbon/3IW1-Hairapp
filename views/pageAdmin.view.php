<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 24/04/2018
 * Time: 16:29
 */

echo "
    <div class='sidenav'>
      <ul>
          <a href= '" . DIRNAME ."admin/getAdmin'>LOGO</a>
          <li class='active sidebar_buttons'><a href='" . DIRNAME ."admin/getPackageAdmin '>Forfaits</a></li>
      
          <li class='sidebar_buttons dropdown'>
            <a>Pages &nbsp;
                <i class='fa fa-caret-down'></i>
            </a>
          </li>
          <div class='dropdown-container'>
            <a href='" . DIRNAME ."admin/getPageEdit '>Ajouter</a>
            
          </div>
          <li class='sidebar_buttons'><a href='". DIRNAME . "admin/getContentAdmin'>articles</a></li>
      </ul>
  </div> ";
?>
    <div class="content">
        <article class="arriere_plan">

            <div class="col-s-12 col-m-8 col-l-12 form_register_admin">

                <div class="col-l-4">
                    <h2 class="center title"> Gestion des utilisateurs</h2>
                </div>

            </div>

            <div class="col-s-12 col-l-12 col-m-9 tab-admin">
                <table class="userManagerTab col-l-12">
                    <tr>
                        <th id="civilite">Civilite</th>
                        <th id="nom">Titre</th>
                        <th id="email">Url</th>
                        <th id="tel">Navbar</th>
                        <th id="status">Active</th>

                    </tr>
                    <tr>
                        <td>M</td>
                        <td>Dylan Settbon</td>
                        <td>bla@gmail.com</td>
                        <td>1234567</td>
                        <td>0</td>
                        <td><a href="#" class="buttonUser">Modifier</a></td>
                        <td><a href="#" class="buttonUser">Supprimer</a></td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>blabl</td>
                        <td>bla@gmail.com</td>
                        <td>1234567</td>
                        <td>0</td>
                        <td><a href="#" class="buttonUser">Modifier</a></td>
                        <td><a href="#" class="buttonUser">Supprimer</a></td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>blabl</td>
                        <td>bla@gmail.com</td>
                        <td>1234567</td>
                        <td>0</td>
                        <td><a href="#" class="buttonUser">Modifier</a></td>
                        <td><a href="#" class="buttonUser">Supprimer</a></td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>blabl</td>
                        <td>bla@gmail.com</td>
                        <td>1234567</td>
                        <td>0</td>
                        <td><a href="#" class="buttonUser">Modifier</a></td>
                        <td><a href="#" class="buttonUser">Supprimer</a></td>
                    </tr>
                    <nav aria-label="navigation">
                        <tr class="page">
                            <td class="previous"><a href="#" title="Précédent">Précédent</a></td>
                            <td class="page center" colspan="5">1/104</td>
                            <td class="next-admin"><a href="#" title="Suivant">Suivant</a></td>
                        </tr>
                    </nav>
                </table>
            </div>
        </article>
    </div>

  </main>

<?php

include "templates/footer.tpl.php";
?>
<script>

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
    console.log( dropdown );
</script>
