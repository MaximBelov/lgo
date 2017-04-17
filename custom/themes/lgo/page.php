<?php get_header(); ?>

<div class="left-panel__background" style="background-image: url(<?php echo get_template_directory_uri();?>/dist/images/installation_speech-splash.jpg);">
	
</div>

<div class="right-panel">

<?php if(have_posts()): while(have_posts()): the_post();

// Get meta content and assign to variable 
$group_values = rwmb_meta( 'accordion_content' ); ?>

<section class="container base-padding no-pad-bottom">
	<div class="row">
		<div class="col s12">
			<h2><?php the_title();?></h2>
			<?php the_content(); ?>
		</div>
	</div>
</section>

<section class="accordion-section base-padding no-padding-top">
    <?php // Accordion
    	if ( ! empty( $group_values ) ) { ?>
		<div class="js-accordion" data-accordion-prefix-classes="animated-accordion">
		<?php foreach ( $group_values as $group_value ) {
			$title 		= isset( $group_value['rw_title'] ) ? $group_value['rw_title'] : '';
			$content 	= wpautop(isset( $group_value['rw_content'] ) ? $group_value['rw_content'] : ''); ?>
			<div class="js-accordion__panel">
				<h3 class="js-accordion__header"><?php echo $title;?></h3>
				<div class="js-accordion__content"><span><?php echo $content; ?></span></div>
			</div>
			<?php } //endforeach ?>
		</div>
		<?php }; //endif !empty 
	// end accordion ?>
			
</section>

<?php endwhile; endif;  ?>
<?php get_footer(); ?>