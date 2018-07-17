<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 28/04/2018
 * Time: 00:32
 */

?>


<div class='sidenav'>
    <header class='header'>
        <div class='logo'>
            <a href='<?php echo DIRNAME;?>admin/getAdmin'>
                <?php if( isset( $logo ) ): ?>
                    <img src="<?php echo DIRNAME.$logo;?>" alt="logo" class="logo">
                <?php endif; ?>
            </a>
        </div>
    </header>
    <ul>

        <a href= '<?php echo DIRNAME;?>admin/getAdmin'></a>
        <li <?php if ( $current_sidebar == 'packages') {echo ' class="sidebar_buttons active" ';} else echo ' class="sidebar_buttons"';?>>
            <a href="<?php echo DIRNAME;?>admin/getPackageAdmin">Forfaits</a>
        </li>

        <li <?php if ( $current_sidebar == 'pages') {echo ' class="sidebar_buttons dropdown" ';} else echo ' class="sidebar_buttons dropdown"';?>>
            <a >Pages &nbsp;
                <i class='fa fa-caret-down'></i>
            </a>
        </li>
        <div class='dropdown-container'>
            <a href="<?php echo DIRNAME;?>admin/getPagesAdmin" >Liste des pages</a>
            <a href="<?php echo DIRNAME;?>admin/getPageEdit" >Ajouter</a>

        </div>

        <li <?php if ( $current_sidebar == 'color') {echo ' class="sidebar_buttons dropdown active" ';} else echo ' class="sidebar_buttons dropdown"';?>>
            <a >Couleur &nbsp;
                <i class='fa fa-caret-down'></i>
            </a>
        </li>

        <div class='dropdown-container'>
            <a href='<?php echo DIRNAME;?>admin/getColorPage'>Couleur principale</a>
            <a href='<?php echo DIRNAME;?>admin/getColorPageBtn'>Couleur secondaire</a>
        </div>

        <li <?php if ( $current_sidebar == 'articles') {echo ' class="sidebar_buttons dropdown active" ';} else echo ' class="sidebar_buttons dropdown"';?>>
            <a >Articles &nbsp;
                <i class='fa fa-caret-down'></i>
            </a>
        </li>

        <div class='dropdown-container'>
            <a href='<?php echo DIRNAME;?>admin/getArticleAdmin'>Ajouter un article</a>
            <a href='<?php echo DIRNAME;?>admin/getCategoryAdmin'>Categories</a>
        </div>

        <li <?php if ( $current_sidebar == 'comments') {echo ' class="sidebar_buttons active" ';} else echo ' class="sidebar_buttons"';?>>
            <a href="<?php echo DIRNAME;?>admin/getCommentAdmin">Comments</a>
        </li>

        <li <?php if ( $current_sidebar == 'appointment') {echo ' class="sidebar_buttons active" ';} else echo ' class="sidebar_buttons"';?>>
            <a href="<?php echo DIRNAME;?>admin/getAppointmentAdmin">Rendez-vous</a>
        </li>

    </ul>
</div>
