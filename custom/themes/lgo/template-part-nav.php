<div class="left-panel__navigation <?php if (is_page_template( 'template-home.php')) { echo 'large-logo'; }?> <?php if (is_page_template( 'template-previouslgs.php')) { echo 'small-nav'; }?>">
    <nav>
        <div class="nav-holder">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo-link"><img class="nav-logo" src="<?php echo get_template_directory_uri();?>/dist/images/lgemblemwhite.svg"></a>
            <?php // wp_nav_menu();?>
            <?php 
                wp_nav_menu(array(
                'menu' => 'Main Menu', 
                'container_id' => 'main-menu-ww', 
                'walker' => new Main_Menu_Walker()
                )); 
            ?> 
        </div>
    </nav>
</div>