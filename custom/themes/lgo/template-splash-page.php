<?php 
/**
* Template Name: Splash Page
*/
get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post();

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
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

$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

<section class="splash-page top-page-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<?php get_template_part( 'template-part-logo' ); ?>
			<h1><?php if($heading) { echo $heading; } else {echo get_the_title();} ?></h1>
			<div class="separator"></div>
			<div class="splash-page-buttons">
				<a href="/en" class="btn splash-page__en">English</a>
				<a href="/fr" class="btn splash-page__fr">FRANÇAIS</a>
			</div>
		</div>
	</div>
	
</section>

<?php endwhile; endif;  ?>

<?php get_footer(); ?>