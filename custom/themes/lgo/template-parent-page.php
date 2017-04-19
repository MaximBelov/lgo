<?php 
/**
* Template Name: Parent Page
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

<div class="top-page-panel" style="background-image: url(<?php echo get_template_directory_uri();?>/dist/images/installation_speech-splash.jpg);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<h1><?php echo $heading;?></h1>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			
		</div>
	</div>
</div>

<div class="page page__bg__fixed" style="background-image: url(<?php echo get_template_directory_uri();?>/dist/images/music_room.jpg);">
<div class="right-compartment">

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

        <div id="<?php echo $child->post_name;?>" class="child-page-content child-page-<?php echo $child->ID;?>" data-child-id="<?php echo $child->ID;?>">
            <h2 class="child-title"><?php echo $child->post_title; ?></h2>
            <?php echo apply_filters( 'the_content', $child->post_content); ?>
        </div>
    <?php } ?>

<?php get_footer(); ?>