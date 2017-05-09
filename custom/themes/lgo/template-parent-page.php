<?php 
/**
* Template Name: Parent Page
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
?>

<?php get_template_part( 'template-part-nav' ); ?>

<div id="scroll-header" class="top-page-panel parent-template" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<h1><?php if($heading) { echo $heading; } else {echo get_the_title();} ?></h1>
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

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed <?php if (is_page_template( 'template-parent-page.php')) { echo 'parent-page-layout'; }?>">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">
		
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

			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' );
			?>

			<?php if ($post->ID == 15) { ?>

			<div id="<?php echo $post->post_name;?>" class="child-page child-page-<?php echo $post->ID;?>" data-child-id="<?php echo $post->ID;?>" data-child-bg="<?php echo $thumb[0];?>">
		        <div class="child-page-content">
		    		<h2 class="child-title"><?php echo $post->post_title; ?></h2>

		        	<?php the_content(); ?>

		        </div>
			    
			    <?php get_template_part( 'template-part-gallery' ); ?>
			</div>

			<?php } else { ?>
			
			<div id="<?php echo $post->post_name;?>" class="child-page child-page-<?php echo $post->ID;?>" data-child-id="<?php echo $post->ID;?>" data-child-bg="<?php echo $thumb[0];?>">
			    <div class="child-page-content">
					<h2 class="child-title"><?php echo $post->post_title; ?></h2>

			    	<?php the_content(); ?>

		    	<?php get_template_part( 'template-part-accordion' ); ?>

		    	<?php get_template_part( 'template-part-slider' ); ?>
			    </div>
			</div>

			<?php } ?>

		<?php }
			wp_reset_postdata();
		} else { ?>
		<?php } ?>
   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->
<?php get_footer(); ?>