<?php 
/**
* Template Name: Home
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

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
$feat2 = rwmb_meta( 'rw_featured_page_2' );
$feat3 = rwmb_meta( 'rw_featured_page_3' );
$feat4 = rwmb_meta( 'rw_featured_page_4' );
$feat5 = rwmb_meta( 'rw_featured_page_5' );
$feat6 = rwmb_meta( 'rw_featured_page_6' );
$feat7 = rwmb_meta( 'rw_featured_page_7' );
$feat8 = rwmb_meta( 'rw_featured_page_8' );
// $feat1ID = $feat1[0];
// print_r($feat1);

$cta1 = rwmb_meta( 'rw_cta_1_title' );
$cta2 = rwmb_meta( 'rw_cta_2_title' );
$cta3 = rwmb_meta( 'rw_cta_3_title' );
$cta1L = rwmb_meta( 'rw_cta_1_link' );
$cta2L = rwmb_meta( 'rw_cta_2_link' );
$cta3L = rwmb_meta( 'rw_cta_3_link' );


if(ICL_LANGUAGE_CODE=='fr'){
$newsLabel = "Fil D’Actualités";
} else {
$newsLabel = 'News Feed';
}

// $random = rand(1,5);

// if ($random == 1) {
//     $imgPath = '/src/images/banners/banner_AmbassadorsReception.jpg';
// } else if ($random == 2) {
//     $imgPath = '/src/images/banners/banner_DukatPhotosLGOwineawards-2015.jpg';
// } else if ($random == 3) {
//     $imgPath = '/src/images/banners/banner_LGO_reception.jpg';
// } else if ($random == 4) {
//     $imgPath = '/src/images/banners/banner_staircase.jpg';
// } else if ($random == 5) {
//     $imgPath = '/src/images/banners/banner_Worldpride-Reception.jpg';
// } else {
//     $imgPath = '/src/images/banner_DukatPhotosLGOwineawards-2015.jpg';
// }

?>

<?php get_template_part( 'template-part-nav-transition' ); ?>

<div id="skip-to-content" class="top-page-panel home-template" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } ?>);background-position: center center;">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<?php //get_template_part( 'template-part-logo' ); ?>
			<h1><span><?php echo $heading;?></span></h1>
			<div class="separator"></div>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			<a href="#top-of-content"><svg width="16px" height="29px" viewBox="0 0 16 29" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <title><?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'Faire défiler'; } else { echo 'Scroll'; } ?></title>
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
			<div class="masonry-grid">
				<?php if ($feat1) {
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php if ($feat2) {
				$args = array( 
					'page_id' => $feat2
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php 
				// the POST query
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					// 'nopaging' => true 
					// 'suppress_filters' => false,
					// 'offset' => 1,
					'post_status' => 'publish',
					'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<!-- pagination here -->
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--2x1--label"><span><?php echo $newsLabel;?></span></p>
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
				<a href="<?php echo $cta1L;?>" class="grid-item grid-item--1x1 grid-item grid-item--accent">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--1x1--label"><?php echo $cta1;?></h3>
					</div>
				</a><a href="<?php echo $facebook;?>" target="_blank" class="grid-item grid-item--1x1 grid-item--llgrey grid-item--facebook grid-item--social-link">
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
						<a href="https://twitter.com/<?php echo $twitter;?>/status/<?php echo $tweetURL;?>" target="_blank" class="grid-item grid-item--2x1 grid-item--twitter">
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
				<?php if ($feat3) {
				$args = array( 
					'page_id' => $feat3
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php if ($feat4) {
				$args = array( 
					'page_id' => $feat4
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php 
				// the POST query
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					// 'nopaging' => true 
					// 'suppress_filters' => false,
					'offset' => 2,
					'post_status' => 'publish',
					// 'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<!-- pagination here -->
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--2x1--label"><span><?php echo $newsLabel;?></span></p>
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
				<a href="http://twitter.com/LGLizDowdeswell" target="_blank" class="grid-item grid-item--1x1 grid-item--llgrey grid-item--twitter grid-item--social-link">
					<div class="grid-item__wrapper">
						<i class="fa fa-twitter" aria-hidden="true"></i>
						<h3 class="grid-item--1x1--label">Twitter</h3>
					</div>
				</a><a href="<?php echo $cta2L;?>" class="grid-item grid-item--1x1 grid-item--accent">
					<div class="grid-item__wrapper"><h3 class="grid-item--1x1--label"><?php echo $cta2;?></h3> </div>
				</a>
				<?php 
				// the POST query
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					// 'nopaging' => true 
					// 'suppress_filters' => false,
					'offset' => 3,
					'post_status' => 'publish',
					// 'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<!-- pagination here -->
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--2x1--label"><span><?php echo $newsLabel;?></span></p>
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
				<a href="<?php echo $cta3L;?>" class="grid-item grid-item--1x1 grid-item--accent">
					<div class="grid-item__wrapper"><h3 class="grid-item--1x1--label"><?php echo $cta3;?></h3> </div>
				</a>

				<!-- ROW 2 -->
				
				<?php if ($feat6) {
				$args = array( 
					'page_id' => $feat6
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php 
				// the POST query
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					// 'nopaging' => true 
					// 'suppress_filters' => false,
					'offset' => 4,
					'post_status' => 'publish',
					// 'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<!-- pagination here -->
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--2x1--label"><span><?php echo $newsLabel;?></span></p>
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
				<a href="https://instagram.com/<?php echo $instagram;?>" target="_blank" class="grid-item grid-item--1x1 grid-item--llgrey grid-item--instagram grid-item--social-link">
					<div class="grid-item__wrapper">
						<i class="fa fa-instagram" aria-hidden="true"></i>
						<h3 class="grid-item--1x1--label">Instagram</h3>
					</div>
				</a>
				<?php 
				// the Twitter query
				$args = array(
					'post_type' => 'tweet',
					'posts_per_page' => 1,
					'offset' => 1
					// 'nopaging' => true
				);
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>

					<!-- pagination here -->

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$tweetURL = get_post_meta( get_the_ID(), 'tweet_id', true);
					?>
						<a href="https://twitter.com/<?php echo $twitter;?>/status/<?php echo $tweetURL;?>" target="_blank" class="grid-item grid-item--2x1 grid-item--twitter">
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
				<?php if ($feat7) {
				$args = array( 
					'page_id' => $feat7
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php if ($feat8) {
				$args = array( 
					'page_id' => $feat8
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

					if($post->post_parent) {
						$thelink = get_permalink($post->post_parent);
					} else {
						$thelink = get_permalink($post->ID);
					}
					?>
						<a href="<?php echo $thelink; ?>" class="grid-item grid-item--4x2" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: left center;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item--4x2--content">
									<h3><?php the_title();?></h3>
									<div><?php the_excerpt();?></div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>

				<?php else : ?>
				<?php endif; } ?>
				<?php 
				// the POST query
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					// 'nopaging' => true 
					// 'suppress_filters' => false,
					'offset' => 5,
					'post_status' => 'publish',
					// 'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<!-- pagination here -->
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--2x1--label"><span><?php echo $newsLabel;?></span></p>
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
				<a href="<?php echo $youtube;?>" target="_blank" class="grid-item grid-item--1x1 grid-item--llgrey grid-item--youtube grid-item--social-link">
					<div class="grid-item__wrapper">
						<i class="fa fa-youtube-play" aria-hidden="true"></i>
						<h3 class="grid-item--1x1--label">Youtube</h3>
					</div>
				</a>
				<?php 
				// the POST query
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					// 'nopaging' => true 
					// 'suppress_filters' => false,
					'offset' => 6,
					'post_status' => 'publish',
					// 'post__in'  => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<!-- pagination here -->
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x1" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);background-position: center center;background-size: cover;background-repeat: no-repeat;">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<p class="grid-item--2x1--label"><span><?php echo $newsLabel;?></span></p>
								<h3 class="grid-item--2x1--label"><?php the_title();?></h3>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
					<!-- pagination here -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<?php endif; ?>
				<div class="grid-item grid-item--filler">
					<a href="/en/news" class="btn btn--accent">View more news</a>
				</div>
			</div>

		</div> <!-- End of RP inner -->
	</div> <!-- END OF RIGHT PANEL -->
</div> <!-- END OF .page -->
<?php get_footer(); ?>