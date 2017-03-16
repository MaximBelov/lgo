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
<meta property="og:image" content="<?php bloginfo('template_url' ); ?>/dist/images/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/dist/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri();?>/dist/images/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/dist/images/favicon-16x16.png">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php include_once("analyticstracking.php") ?>

<section class="navbar-fixed menu">
    <nav role="navigation">
        <div class="nav-wrapper">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="brand-logo" src="<?php echo get_template_directory_uri();?>/dist/images/revive.png"></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#contact">Work with Us</a></li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#contact">Work with Us</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons menu">menu</i></a>
        </div>
    </nav>
</section>
