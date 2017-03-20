<!DOCTYPE html>
<html lang="en">
<head>
<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name') ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name') ?>">
<meta property="og:title" content="<?php bloginfo('name') ?>">
<meta property="og:description" content="<?php bloginfo('description'); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php include_once("analyticstracking.php") ?>


<div id="nav-icon3" class="nav-trigger">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <small>MENU</small>
</div>

<div class="navbar-fixed">
    <nav role="navigation" >
        <div class="nav-wrapper container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo-holder"><img class="brand-logo" src="<?php echo get_template_directory_uri();?>/dist/images/lgemblemwhite.svg"></a>
            <?php wp_nav_menu();?>
        </div>
    </nav>
</div>


