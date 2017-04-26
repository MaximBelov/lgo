<?php 
/**
* Template Name: Home
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
?>

<?php get_template_part( 'template-part-nav-transition' ); ?>

<div id="skip-to-content" class="top-page-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<h1><?php echo $heading;?></h1>
			<div class="separator"></div>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			<svg width="80px" height="45px" viewBox="508 585 80 45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			    <desc>Created with Sketch.</desc>
			    <defs></defs>
			    <polyline id="Path-2" stroke="#FFFFFF" stroke-width="3" fill="none" points="510 589.199219 546.746094 627.386719 586.171875 587"></polyline>
			</svg>
		</div>
	</div>
</div>

<div class="full-width-panel">
<div> <!-- Start of RP -->
<div class="full-width-inner-wrapper"> <!-- Start of RP inner -->
	<h2>Ontario's Storyteller in chief</h2>
	
	<div class="masonry-grid">
		<div class="grid-item grid-item--4x2 wow fadeInUp"></div>
		<div class="grid-item grid-item--4x2 wow fadeInUp"></div>
		<div class="grid-item grid-item--2x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--4x2 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--4x2 wow fadeInUp"></div>
		<div class="grid-item grid-item--2x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--2x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--1x1 wow fadeInUp"></div>
		<div class="grid-item grid-item--2x2 wow fadeInUp"></div>
	</div>

<?php get_footer(); ?>