<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 28/04/2018
 * Time: 00:32
 */

?>

<div class='sidenav'>
    <ul>
        <a href= '<?php echo DIRNAME;?>admin/getAdmin'>LOGO</a>
        <li <?php if ( $this->data['current_sidebar'] == 'packages') {echo ' class="sidebar_buttons active" ';} else echo ' class="sidebar_buttons"';?>>
            <a href="<?php echo DIRNAME;?>admin/getPackageAdmin">Forfaits</a>
        </li>

        <li <?php if ( $this->data['current_sidebar'] == 'pages') {echo ' class="sidebar_buttons dropdown active" ';} else echo ' class="sidebar_buttons dropdown"';?>>
            <a >Pages &nbsp;
                <i class='fa fa-caret-down'></i>
            </a>
        </li>
        <div class='dropdown-container'>
            <a href="<?php echo DIRNAME;?>admin/getPagesAdmin" >Liste des pages</a>
            <a href="<?php echo DIRNAME;?>admin/getPageEdit" >Ajouter</a>

        </div>
        <li class='sidebar_buttons'>
            <a href='<?php echo DIRNAME;?>admin/getArticleAdmin'>Articles</a>
        </li>
          <li class='sidebar_buttons'>
            <a href='<?php echo DIRNAME;?>admin/getCategoryAdmin'>Category</a>
        </li>

    </ul>
</div>
