<?php get_header(); ?>

<?php get_template_part( 'template-part-nav-narrow' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
?>

<?php get_template_part( 'template-part-social-share' ); ?>

<div class="full-width-panel">
	<div class="inner-wrapper-blog">

		<section class="news-banner" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
		</section>

		<section class="news-content" id="skip-to-content">
			<div class="news-content__titles">
				<p class="news-content__date">
					<?php if(ICL_LANGUAGE_CODE=='fr'){ ?>
						<?php the_time('j F Y'); ?>
					<?php } else { ?>
						<?php the_time('F j, Y'); ?>
					<?php } ?>
				</p>
				<h1><?php the_title();?></h1>
			</div>
			<div class="news-content__body">
				<?php the_content();?>

				<?php get_template_part( 'template-part-accordion' ); ?>

				<?php get_template_part( 'template-part-slider' ); ?>
			</div>
		</section>

	</div>
</div>
<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>