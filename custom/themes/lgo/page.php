<?php get_header(); ?>

<?php get_template_part( 'template-part-nav' ); ?>

<?php if(have_posts()): while(have_posts()): the_post(); 
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

$cta_copy   = rwmb_meta( 'rw_cta_blurb' );
$cta_btns   = rwmb_meta( 'cta' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

<?php if ($cta_copy) { ?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--half">
	<div class="cta-container">
		<div class="cta__content">
			<?php echo $cta_copy; ?>
			<?php if ( ! empty( $cta_btns ) ) { foreach ( $cta_btns as $cta_btn ) {
                    $label 	= $cta_btn['rw_btn_label'];
                    $url    = $cta_btn['rw_btn_url'];
                    ?>
                    <a href="<?php echo $url; ?>" class="btn"><?php echo $label; ?></a>
                <?php }
			} ?>
		</div>
	</div>
	<div class="left-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);background-size: cover;">
	</div><div class="right-panel">
		<div class="single-page__content">
			<h2><?php the_title();?></h2>
			<?php the_content(); ?>
		</div>
		<?php get_template_part( 'template-part-accordion' ); ?>

		<?php get_template_part( 'template-part-slider' ); ?>
	</div>
</div>

<?php } else { ?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">
		
		<div class="single-page__content">
		<h2><?php the_title();?></h2>
		<div class="single-lg__content-wysiwyg"><?php the_content(); ?></div>

		<?php get_template_part( 'template-part-accordion' ); ?>

		<?php get_template_part( 'template-part-slider' ); ?>
		</div>
		
   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->

<?php } ?>

<?php endwhile; endif;  ?>

<?php get_footer(); ?>