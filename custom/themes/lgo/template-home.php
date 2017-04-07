<?php 
/**
* Template Name: Home
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
			<div class="separator"></div>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			<svg width="80px" height="45px" viewBox="508 585 80 45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->
			    <desc>Created with Sketch.</desc>
			    <defs></defs>
			    <polyline id="Path-2" stroke="#FFFFFF" stroke-width="3" fill="none" points="510 589.199219 546.746094 627.386719 586.171875 587"></polyline>
			</svg>
		</div>
	</div>
</div>

<div class="left-panel__background left-panel__background---down">
	
</div>

<div class="right-panel">

<?php if(have_posts()): while(have_posts()): the_post();

// Get meta content and assign to variable 
$group_values = rwmb_meta( 'accordion_content' ); ?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="parallax-container valign-wrapper">
		<div class="container">
			<div class="row">
				<div class="col s12 m8 offset-m2">
					<h1><?php the_title();?></h1>
				</div>
			</div>
		</div>
    	<div class="parallax overlay"><img src="<?php the_post_thumbnail_url(); ?>"></div>
    </div>
<?php elseif (!has_post_thumbnail() ) : ?>
	<div id="skip-to-content">
		<h4><?php the_title();?></h4>
	</div>
<?php endif; ?>

<section class="container base-padding no-pad-bottom">
	<div class="row">
		<div class="col s12">
			<?php the_content(); ?>
		</div>
	</div>
</section>

<section class="accordion-section base-padding no-padding-top">
    <?php // Accordion
    	if ( ! empty( $group_values ) ) { ?>
		<ul class="collapsible" data-collapsible="accordion">
		<?php foreach ( $group_values as $group_value ) {
			$title 		= isset( $group_value['rw_title'] ) ? $group_value['rw_title'] : '';
			$content 	= wpautop(isset( $group_value['rw_content'] ) ? $group_value['rw_content'] : ''); ?>
			<li>
				<div class="collapsible-header"><i class="material-icons right">add_circle_outline</i><?php echo $title; ?></div>
				<div class="collapsible-body"><span><?php echo $content; ?></span></div>
			</li>
			<?php } //endforeach ?>
		</ul>
		<?php }; //endif !empty 
	// end accordion ?>
			
</section>

<?php endwhile; endif;  ?>
<?php get_footer(); ?>