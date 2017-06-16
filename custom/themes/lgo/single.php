<?php get_header(); ?>

<?php get_template_part( 'template-part-nav-narrow' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
$templateOpt = rwmb_meta( 'rw_post_template' );

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

<?php if ($templateOpt == 1) { ?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-lg single-event single-push-panel">

	<div class="left-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);background-size: cover;background-position: center center;background-repeat: no-repeat;">
	</div><div class="right-panel">
		<div class="single-lg__content single-event__content">

			<h2><?php the_title();?></h2>
			<div class="single-lg__content-wysiwyg"><?php the_content(); ?></div>

			<div class="single-lg__prev-next-links">
				
				<?php if (get_previous_post()) { 
				$prev = get_previous_post();
				$prevURL = get_permalink($prev);
				?>
				<div class="single-lg__prev-link">
					<a href="<?php echo $prevURL; ?>"><svg id="prev-link-arrow" width="21px" height="15px" viewBox="0 0 21 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <g id="arrow-body" transform="translate(-621.000000, -592.000000)">
						            <path d="M642.025825,599.67788 C642.025825,599.499078 641.914247,599.262217 641.802669,599.148154 L635.457007,592.597228 C635.161934,592.300253 634.680192,592.265829 634.335411,592.566914 C634.027647,592.8382 634.019186,593.363815 634.304212,593.65668 L639.398192,598.907183 L622.195631,598.907183 C621.75778,598.907183 621.402423,599.252455 621.402423,599.67788 C621.402423,600.103305 621.75778,600.448577 622.195631,600.448577 L639.398192,600.448577 L634.304212,605.69908 C634.019186,605.991945 634.039809,606.505743 634.335411,606.788846 C634.647406,607.087877 635.165635,607.061673 635.457007,606.758532 L641.802669,600.207606 C641.988809,600.029318 642.02371,599.858737 642.025825,599.67788 Z" id="Page-1" transform="translate(631.714124, 599.678571) scale(-1, 1) translate(-631.714124, -599.678571) "></path>
						        </g>
						    </g>
						</svg></a>
					<?php previous_post_link('%link'); ?>
				</div>
				<?php } ?>
				
				<?php if (get_next_post()) { 
				$next = get_next_post();
				$nextURL = get_permalink($next);
				?>
				<div class="single-lg__next-link">
					<?php next_post_link('%link'); ?>
					<a href="<?php echo $nextURL; ?>"><svg id="next-link-arrow" width="21px" height="15px" viewBox="0 0 21 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <g id="arrow-body" transform="translate(-917.000000, -620.000000)">
						            <path d="M938.025825,627.67788 C938.025825,627.499078 937.914247,627.262217 937.802669,627.148154 L931.457007,620.597228 C931.161934,620.300253 930.680192,620.265829 930.335411,620.566914 C930.027647,620.8382 930.019186,621.363815 930.304212,621.65668 L935.398192,626.907183 L918.195631,626.907183 C917.75778,626.907183 917.402423,627.252455 917.402423,627.67788 C917.402423,628.103305 917.75778,628.448577 918.195631,628.448577 L935.398192,628.448577 L930.304212,633.69908 C930.019186,633.991945 930.039809,634.505743 930.335411,634.788846 C930.647406,635.087877 931.165635,635.061673 931.457007,634.758532 L937.802669,628.207606 C937.988809,628.029318 938.02371,627.858737 938.025825,627.67788 Z" id="Page-1"></path>
						        </g>
						    </g>
						</svg></a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	
</div>

<?php } else { ?>

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

<?php } ?>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>