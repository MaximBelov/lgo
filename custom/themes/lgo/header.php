<!DOCTYPE html>
<html lang="<?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'fr'; } else { echo 'en'; } ?>">
<head>
<title><?php wp_title(''); ?></title>
<?php if (is_single()) { 
  $TwitterCrop = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'twitter' );
  $FBCrop = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'facebook' );

  if ($TwitterCrop != false && $FBCrop != false) {
    $TwitterCard = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'twitter' );
    $TwitterThumbnail = $TwitterCard[0];
    $FBCard = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'facebook' );
    $FBThumbnail = $FBCard[0];
  } else if ($TwitterCrop != false) {
    $TwitterCard = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'twitter' );
    $TwitterThumbnail = $TwitterCard[0];
    $FBThumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large' );
  } else if($FBCrop != false) {
    $TwitterThumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large' );
    $FBCard = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID() ), 'facebook' );
    $FBThumbnail = $FBCard[0];
  } else {
    $TwitterThumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large' );
    $FBThumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large' );
  }
?>
  <!-- Twitter & Facebook Meta Tags  – Yoast already does some of this -->
  <!-- <meta property="og:url" content="<?php //echo esc_url( get_permalink( get_the_ID() ) ); ?>"/>
  <meta property="og:title" content="<?php //echo get_the_title( get_the_ID() ); ?>"/>
  <meta property="og:site_name" content="Lieutenant Governor of Ontario / Lieutenante-gouverneure de l'Ontario"/>
  <meta property="og:description" content=""/> -->
  <meta property="og:image" content="<?php echo $FBThumbnail; ?>" />
  <!-- <meta property="og:type" content="website" /> -->
  <meta name="twitter:card" content="summary_large_image" />
  <!-- <meta name="twitter:site" content="@LGLizDowdeswell" />
  <meta name="twitter:creator" content="@LGLizDowdeswell" /> -->
  <meta name="twitter:image" content="<?php echo $TwitterThumbnail; ?>" />  
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/dist/images/favicon.ico" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Dosis:300,500,700|Rasa:400,500,600|Merriweather:400i" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1.0"/>
<meta name="description" content="<?php bloginfo('description'); ?>" />
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