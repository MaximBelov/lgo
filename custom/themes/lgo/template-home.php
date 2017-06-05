<?php 
/**
* Template Name: Home
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 

if(get_option('lgo_option_name')){
    $options = get_option( 'lgo_option_name' );
} else {
	$options = array(
		"lgo_twitter" => "twitterusername",
		"lgo_facebook" => "facebooklink",
		"lgo_instagram" => "instagramusername",
		"lgo_youtube" => "youtubelink"
	);
}
$twitter = $options['lgo_twitter'];
$facebook = $options['lgo_facebook'];
$instagram = $options['lgo_instagram'];
$youtube = $options['lgo_youtube'];

$feat1 = rwmb_meta( 'rw_featured_page_1' );
// $feat1ID = $feat1[0];
// print_r($feat1);

$cta1 = rwmb_meta( 'rw_cta_1_title' );
$cta2 = rwmb_meta( 'rw_cta_2_title' );
$cta3 = rwmb_meta( 'rw_cta_3_title' );
$cta1L = rwmb_meta( 'rw_cta_1_link' );
$cta2L = rwmb_meta( 'rw_cta_2_link' );
$cta3L = rwmb_meta( 'rw_cta_3_link' );

?>

<?php get_template_part( 'template-part-nav-transition' ); ?>

<div id="skip-to-content" class="top-page-panel home-template" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<?php get_template_part( 'template-part-logo' ); ?>
			<h1><?php echo $heading;?></h1>
			<div class="separator"></div>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			<a href="#top-of-content"><svg width="16px" height="29px" viewBox="0 0 16 29" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <desc>Scroll Down</desc>
				    <defs></defs>
				    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g id="down-arrow-banner" transform="translate(-537.000000, -609.000000)">
				            <path d="M559.160469,623.320737 C559.160469,623.141936 559.008113,622.905075 558.855758,622.791011 L550.190998,616.240085 C549.788087,615.94311 549.130287,615.908686 548.659502,616.209771 C548.239261,616.481057 548.227708,617.006672 548.6169,617.299537 L555.572536,622.55004 L532.083095,622.55004 C531.485227,622.55004 531,622.895312 531,623.320737 C531,623.746162 531.485227,624.091434 532.083095,624.091434 L555.572536,624.091434 L548.6169,629.341937 C548.227708,629.634802 548.255869,630.1486 548.659502,630.431703 C549.085519,630.730734 549.793142,630.70453 550.190998,630.401389 L558.855758,623.850463 C559.109924,623.672175 559.15758,623.501594 559.160469,623.320737 Z" id="Page-1" transform="translate(545.080234, 623.321429) scale(-1, 1) rotate(90.000000) translate(-545.080234, -623.321429) "></path>
				        </g>
				    </g>
				</svg></a>
		</div>
	</div>
</div>

<div id="top-of-content" class="full-width-panel">
	<div> <!-- Start of RP -->
		<div class="full-width-inner-wrapper"> <!-- Start of RP inner -->
			<!-- <h2>Ontario's Storyteller in chief</h2> -->
			<div class="masonry-grid">
				<a href="#" class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<div class="grid-item--4x2--content">
							<h3>Use this tile style for featured static content</h3>
						</div>
					</div>
				</a>
				<?php 
				$args = array( 
					'page_id' => $feat1
				);
				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--4x2 wow fadeInUp" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--4x2--label"><span>About</span></p>
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<p><?php the_excerpt();?></p>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; ?>
				<?php
					$args = array( 
						'post_type' => 'post',
						'numberposts' => '1', 
						'suppress_filters' => false,
						'post_status' => 'publish'
					);
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
					$postTitle = get_the_title($recent['ID']); ?>
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1 wow fadeInUp">
							<div class="grid-item__wrapper">
								<h3 class="grid-item--2x1--label"><?php echo $postTitle;?></h3>
							</div>
						</a>
					<?php }
					wp_reset_query();
				?>
				<a href="<?php echo $cta1L;?>" class="grid-item grid-item--1x1 grid-item grid-item--accent wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--1x1--label"><?php echo $cta1;?></h3>
					</div>
				</a><a href="http://facebook.com/LGLizDowdeswell" target="_blank" class="grid-item grid-item--1x1 grid-item--llgrey wow fadeInUp grid-item--facebook grid-item--social-link">
					<div class="grid-item__wrapper">
						<i class="fa fa-facebook" aria-hidden="true"></i>
						<h3 class="grid-item--1x1--label">Facebook</h3>
					</div>
				</a>
				<?php 
				// the Twitter query
				$args = array(
					'post_type' => 'tweet',
					'posts_per_page' => 1,
					// 'nopaging' => true
				);
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>

					<!-- pagination here -->

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$tweetURL = get_post_meta( get_the_ID(), 'tweet_id', true);
					?>
						<a href="https://twitter.com/LGLizDowdeswell/status/<?php echo $tweetURL;?>" target="_blank" class="grid-item grid-item--2x1 wow fadeInUp grid-item--twitter">
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
				<?php endif; ?>
				<a href="#" class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<div class="grid-item--4x2--content">
							<h3>Use this tile style for LG exhibitions</h3>
						</div>
					</div>
				</a><a href="#" class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<p class="grid-item--4x2--label"><span>Current Exhibit</span></p>
						<div class="grid-item--4x2--content">
							<h3>Canada 150</h3>
							<p>Each story recalls an experience that has left an impression—one of happiness or tragedy, of humour, or of insight. Collectively these myriad diverse stories give us meaning, through which our personal, family, and community identities are formed.</p>
						</div>
					</div>
				</a>
				<?php
					$args = array( 
						'post_type' => 'post',
						'numberposts' => '1', 
						'suppress_filters' => false,
						'offset' => 1,
						'post_status' => 'publish'
					);
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
					$postTitle = get_the_title($recent['ID']); ?>
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1 wow fadeInUp">
							<div class="grid-item__wrapper">
								<h3 class="grid-item--2x1--label"><?php echo $postTitle;?></h3>
							</div>
						</a>
					<?php }
					wp_reset_query();
				?>
				<a href="http://twitter.com/LGLizDowdeswell" target="_blank" class="grid-item grid-item--1x1 grid-item--llgrey wow fadeInUp grid-item--twitter grid-item--social-link">
					<div class="grid-item__wrapper">
						<i class="fa fa-twitter" aria-hidden="true"></i>
						<h3 class="grid-item--1x1--label">Twitter</h3>
					</div>
				</a><a href="<?php echo $cta2L;?>" class="grid-item grid-item--1x1 grid-item--accent wow fadeInUp">
					<div class="grid-item__wrapper"><h3 class="grid-item--1x1--label"><?php echo $cta2;?></h3> </div>
				</a>
				<?php
					$args = array( 
						'post_type' => 'post',
						'numberposts' => '1', 
						'suppress_filters' => false,
						'post_status' => 'publish',
						'offset' => 2,
					);
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
					$postTitle = get_the_title($recent['ID']); ?>
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1 wow fadeInUp">
							<div class="grid-item__wrapper">
								<h3 class="grid-item--2x1--label"><?php echo $postTitle;?></h3>
							</div>
						</a>
					<?php }
					wp_reset_query();
				?>
				<a href="<?php echo $cta3L;?>" class="grid-item grid-item--1x1 grid-item--accent wow fadeInUp">
					<div class="grid-item__wrapper"><h3 class="grid-item--1x1--label"><?php echo $cta3;?></h3> </div>
				</a><!-- <a href="#" class="grid-item grid-item--2x2 wow fadeInUp">
					<div class="grid-item--overlay"></div>
					<div class="grid-item__wrapper">
						<h3 class="grid-item--2x2--label">Use this tile style for blog posts with a picture.</h3>
					</div>
				</a> -->
			</div>

			<div class="load-more-container">
				<a align="center" href="<?php if(ICL_LANGUAGE_CODE=='fr'){
						echo esc_url( get_permalink(478) );
					} else { 
						echo esc_url( get_permalink(353) );
					} ?>" class="btn btn--accent">More news & events</a>
			</div>

		</div> <!-- End of RP inner -->
	</div> <!-- END OF RIGHT PANEL -->
</div> <!-- END OF .page -->
<?php get_footer(); ?>