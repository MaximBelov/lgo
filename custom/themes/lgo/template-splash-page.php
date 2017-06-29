<?php 
/**
* Template Name: Splash Page
*/
get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post();

if (wp_is_mobile()) {
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); 
} else {
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
}

$random = rand(1,5);

if ($random == 1) {
    $imgPath = '/src/images/banners/banner_AmbassadorsReception.jpg';
} else if ($random == 2) {
    $imgPath = '/src/images/banners/banner_DukatPhotosLGOwineawards-2015.jpg';
} else if ($random == 3) {
    $imgPath = '/src/images/banners/banner_LGO_reception.jpg';
} else if ($random == 4) {
    $imgPath = '/src/images/banners/banner_staircase.jpg';
} else if ($random == 5) {
    $imgPath = '/src/images/banners/banner_Worldpride-Reception.jpg';
} else {
    $imgPath = '/src/images/banner_DukatPhotosLGOwineawards-2015.jpg';
}

$subhead   	= rwmb_meta( 'rw_banner_subheading' );
$eng   		= rwmb_meta( 'rw_splash_en_heading' );
$engCopy   	= rwmb_meta( 'rw_splash_en_copy' );
$fr   		= rwmb_meta( 'rw_splash_fr_heading' );
$frCopy   	= rwmb_meta( 'rw_splash_fr_copy' );
?>

<section class="splash-page top-page-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<div class="splash-page__logo splash-logo-mobile"><?php get_template_part( 'template-part-logo' ); ?></div>
			<div class="splash-section__EN">
				<h1><span><?php if($eng) { echo $eng; } else {echo get_the_title();} ?></span></h1>
				<p><?php echo $engCopy;?></p>
				<div class="splash-page-buttons">
					<a href="/" class="btn splash-page__en">English</a>
				</div>
			</div><div class="splash-page__logo splash-logo-dt"><?php get_template_part( 'template-part-logo' ); ?></div><div class="splash-section__FR">
				<h1><span><?php if($fr) { echo $fr; } else {echo get_the_title();} ?></span></h1>
				<p><?php echo $frCopy;?></p>
				<div class="splash-page-buttons">
					<a lang=”fr-CA” href="/" class="btn splash-page__fr">FRANÇAIS</a>
				</div>
			</div>
		</div>
	</div>
	
</section>

<?php endwhile; endif;  ?>

<?php get_footer(); ?>