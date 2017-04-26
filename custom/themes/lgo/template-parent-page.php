<?php 
/**
* Template Name: Parent Page
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

<?php get_template_part( 'template-part-nav' ); ?>

<div id="scroll-header" class="top-page-panel" style="background-image: url(<?php echo get_template_directory_uri();?>/dist/images/installation_speech-splash.jpg);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<h1><?php if($heading) { echo $heading; } else {echo get_the_title();} ?></h1>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
		</div>
	</div>
</div>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed <?php if (is_page_template( 'template-parent-page.php')) { echo 'parent-page-layout'; }?>" style="background: url(<?php echo get_template_directory_uri();?>/dist/images/music_room.jpg);">
	<div class="dark-overlay"></div>
	<div class="right-compartment">
		<div class="right-compartment-inner-wrapper">
	    	<div class="parent-page-content">
	    	<?php the_content(); ?>
	    	</div>

	    	<?php
	    	$theID = get_the_ID();
	    	// print_r($theID);
    		$args = array(
    			'post_type'      => 'page',
    			'post_parent' => $theID,
    		    'order' => 'ASC',
    		    'orderby' => 'menu_order'
    		);
	    	// The Query
	    	$the_query = new WP_Query( $args );

	    	// The Loop
	    	if ( $the_query->have_posts() ) {
	    		while ( $the_query->have_posts() ) {
	    			$the_query->the_post(); 

	    		$thumb = $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' );
	    		?>
	    		
			<div id="<?php echo $post->post_name;?>" class="child-page child-page-<?php echo $post->ID;?>" data-child-id="<?php echo $post->ID;?>" data-child-bg="<?php echo $thumb;?>">
			    <h2 class="child-title"><?php echo $post->post_title; ?></h2>
			    <div class="child-page-content">

			    	<?php the_content(); ?>

			    	<?php get_template_part( 'template-part-accordion' ); ?>

			    	<?php get_template_part( 'template-part-slider' ); ?>



			    </div>
			</div>

	    	<?php }
	    		wp_reset_postdata();
	    	} else { ?>
	    	<?php } ?>

<?php get_footer(); ?>