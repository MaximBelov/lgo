<?php get_header(); ?>

<?php get_template_part( 'template-part-nav-narrow' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

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

?>

<?php get_template_part( 'template-part-social-share' ); ?>

<div class="full-width-panel">
	<div class="inner-wrapper-blog">

		<section class="news-banner" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);">
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