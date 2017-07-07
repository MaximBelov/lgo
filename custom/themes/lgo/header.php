<!DOCTYPE html>
<html lang="<?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'fr'; } else { echo 'en'; } ?>">
<head>
<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name') ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/dist/images/favicon.ico" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Dosis:300,500,700|Rasa:400,500,600|Merriweather:400i" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1.0"/>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<!-- FB Meta Tags -->
<!-- CREATE/REPLACE FB APP ID -->
<meta property="fb:app_id" content="123456789" />
<meta property="og:site_name" content="<?php bloginfo('name') ?>">
<meta property="og:title" content="<?php bloginfo('name') ?>">
<meta property="og:description" content="<?php bloginfo('description'); ?>">
<meta property="og:image" content="<?php if (has_post_thumbnail()) { echo the_post_thumbnail_url('medium');} ?>">
<meta property="og:url" content="http://www.lgontario.ca">
<!-- Twitter Meta Tags -->
<meta name="twitter:title" content="<?php bloginfo('name') ?>">
<meta name="twitter:description" content="<?php bloginfo('description'); ?>">
<meta name="twitter:image" content="<?php if (has_post_thumbnail()) { echo the_post_thumbnail_url('medium');} ?>">
<meta name="twitter:card" content="summary_large_image">

<?php wp_head(); ?>
<?php include_once("analyticstracking.php") ?>
</head>

<body <?php body_class(); ?>>

<?php if (!is_page_template( 'template-splash-page.php' )) { ?>
<a href="#skip-to-content" class="skip-to" tabindex="1"><?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'Aller au contenu'; } else { echo 'Skip to content'; } ?></a>
<?php } ?>

<?php if (!is_page_template( 'template-splash-page.php' )) { ?>
<div tabindex="1" id="nav-icon3" class="nav-trigger">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <small>MENU</small>
</div>
<?php } ?>