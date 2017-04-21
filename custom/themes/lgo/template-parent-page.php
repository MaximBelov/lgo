<?php 
/**
* Template Name: Parent Page
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

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

<div id="scroll-panel" class="page-panel page__bg__fixed <?php if (is_page_template( 'template-parent-page.php')) { echo 'parent-page-layout'; }?>" style="background: url(<?php echo get_template_directory_uri();?>/dist/images/music_room.jpg);">
	<div class="dark-overlay"></div>
	<div class="right-compartment">
		<div class="right-compartment-inner-wrapper">
	    	<div class="parent-page-content">
	    	<?php the_content(); ?>
	    	</div>

		    <?php
		    $childArgs = array(
		        'sort_order' => 'ASC',
		        'sort_column' => 'menu_order',
		        'child_of' => get_the_ID()
		    );
		    $childList = get_pages($childArgs);
		    foreach ($childList as $child) { ?>
	        <div id="<?php echo $child->post_name;?>" class="child-page child-page-<?php echo $child->ID;?>" data-child-id="<?php echo $child->ID;?>">
	            <h2 class="child-title"><?php echo $child->post_title; ?></h2>
	            <div class="child-page-content"><?php echo apply_filters( 'the_content', $child->post_content); ?></div>
	        </div>
		    <?php } ?>

<?php get_footer(); ?>