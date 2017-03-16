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

<section class="navbar-fixed menu">
    <nav role="navigation">
        <div class="nav-wrapper">
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Menu</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Menu</a></li>
            </ul>
            <ul id="nav-mobile" class="side-nav">
                <li><a href="#">Menu</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Menu</a></li>

            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons menu">menu</i></a>
        </div>
    </nav>
</section>


