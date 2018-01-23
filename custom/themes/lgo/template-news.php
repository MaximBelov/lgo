<?php 
/**
* Template Name: News
*/
get_header(); ?>

<?php get_template_part( 'template-part-nav' ); ?>

<?php if(have_posts()): while(have_posts()): the_post(); 
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

$cta_copy   = rwmb_meta( 'rw_cta_blurb' );
$cta_btns   = rwmb_meta( 'cta' );
$subhead   	= rwmb_meta( 'rw_banner_subheading' );
?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">

		<div class="news-inner-wrapper">
			<h1><?php the_title();?></h1>
			
			<div id="activities-feed">
				<?php 
				// the Post query
				//Protect against arbitrary paged values
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
				$args = array(
					'post_type' => array('post'),
					'posts_per_page' => 30,
					'paged' => $paged,
					// 'nopaging' => true
				);
				$the_query = new WP_Query( $args ); ?>
			
				<?php if ( $the_query->have_posts() ) : ?>
			
					<!-- pagination here -->
			
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$tweetURL = get_post_meta( get_the_ID(), 'tweet_id', true);
						$random = rand(1,5);
						$specialCrop = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'event-card' );

						if ($specialCrop != false) {
							$eventCard = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'event-card' );
							// print_r($eventCard[0]);
							$thumbnail = $eventCard[0];
						} else {
							$thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large' );
						}
			
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
						<a href="<?php the_permalink();?>" class="grid-item grid-item--2x2" style="background-image: url(<?php if (has_post_thumbnail()) { ?><?php echo $thumbnail; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);">
							<div class="grid-item--overlay"></div>
							<div class="grid-item__wrapper">
								<div class="grid-item__inner-wrapper">
									<p class="grid-item__date"><?php if(ICL_LANGUAGE_CODE=='fr'){ ?>
										<?php the_time('j F Y'); ?>
									<?php } else { ?>
										<?php the_time('F j, Y'); ?>
									<?php } ?></p>
									<h3 class="grid-item--2x2--label"><?php the_title();?></h3>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
					<!-- end of the loop -->
			
					<!-- pagination here -->
			
					<?php wp_reset_postdata(); ?>
			
				<?php else : ?>
					<!-- <p><?php //_e( 'Sorry, no posts matched your criteria.' ); ?></p> -->
				<?php endif; ?>

				<div class="news-pagination grid-item grid-item--filler">
					<div class="news-pagination--inner"><?php
						$big = 999999999; // need an unlikely integer
						 
						echo paginate_links( array(
						    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						    'format' => '?paged=%#%',
						    'current' => max( 1, get_query_var('paged') ),
						    'total' => $the_query->max_num_pages
						) );
						?>
					</div>
				</div>
			
			</div>

		</div>
		

   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->
<?php endwhile; endif;  ?>


<?php get_footer(); ?>