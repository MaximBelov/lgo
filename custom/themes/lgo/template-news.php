<?php 
/**
* Template Name: News
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 

if(get_option('lgo_option_name')){
    $options = get_option( 'lgo_option_name' );
} else {
	$options = array(
		"lgo_twitter" => "twitterusername"
	);
}
$twitter = $options['lgo_twitter'];

?>

<?php get_template_part( 'template-part-nav-transition' ); ?>

<div id="skip-to-content" class="top-page-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<h1><?php echo $heading;?></h1>
			<div class="separator"></div>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			<svg width="80px" height="45px" viewBox="508 585 80 45" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			    <desc>Lieutenant Governor Emblem</desc>
			    <defs></defs>
			    <polyline id="Path-2" stroke="#FFFFFF" stroke-width="3" fill="none" points="510 589.199219 546.746094 627.386719 586.171875 587"></polyline>
			</svg>
		</div>
	</div>
</div>

<div class="full-width-panel">
	<div> <!-- Start of RP -->
		<div class="full-width-inner-wrapper"> <!-- Start of RP inner -->
			
			<div class="masonry-grid" id="activities-feed">

				<?php 
				// the Twitter query
				$args = array(
					'post_type' => 'tweet',
					'posts_per_page' => 30,
					// 'nopaging' => true
				);
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>

					<!-- pagination here -->

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$tweetURL = get_post_meta( get_the_ID(), 'tweet_id', true);
					?>
						<a href="https://twitter.com/LGLizDowdeswell/status/<?php echo $tweetURL;?>" class="grid-item grid-item--2x1 wow fadeInUp grid-item--twitter">
							<div class="grid-item__wrapper">
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->

					<!-- pagination here -->

					<?php wp_reset_postdata(); ?>

				<?php else : ?>
					<!-- <p><?php //_e( 'Sorry, no posts matched your criteria.' ); ?></p> -->
				<?php endif; ?>

				<div class="load-more-container">
					<a align="center" href="http://twitter.com/<?php echo $twitter; ?>" target="_blank" class="btn btn--accent">Visit the twitter feed</a>
				</div>

			</div>
		</div> <!-- End of RP inner -->
	</div> <!-- END OF RIGHT PANEL -->
</div> <!-- END OF .page -->
<?php get_footer(); ?>