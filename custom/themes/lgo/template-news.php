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


// print_r($tax_query);
?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">

		<div class="news-inner-wrapper">
			<h1><?php the_title();?></h1>

			<form method="get" action="<?php bloginfo( 'url' ); ?>/events/" class="events-filter">
				<div id="filter-trigger">
				<button type="button" aria-pressed="false" id="trigger-button">
				Filter events by theme
				</button>
				</div>
                <div id="show" class="hide-filters">  
                    <div>
                        <ul class="collapsible filter-container" data-collapsible="accordion">
							<?php
							/** The taxonomy we want to parse */
							$taxonomy = "theme";
							/** Get all taxonomy terms */
							$terms = get_terms($taxonomy, array(
									// "orderby"    => "count",
									"hide_empty" => false
								)
							);
							/** Get terms that have children */
							$hierarchy = _get_term_hierarchy($taxonomy);
								/** Loop through every term */
								
								foreach($terms as $term) {
									//Skip term if it has children
									if($term->parent) {
										continue;
									} 
									// print_r($term);
									echo '<li class="parent-list">';
									echo '<span>'.$term->name.'</span>';    
									/** If the term has children... */
									if($hierarchy[$term->term_id]) {
										/** display them */
										echo '<ul>';
										
										foreach($hierarchy[$term->term_id] as $child) {
											/** Get the term object by its ID */
											$checked = array();
											$checked = (isset($_GET[$term->slug]) ? $_GET[$term->slug] : null); 
											$child = get_term($child, "theme");
											if(!empty($checked) && in_array($child->term_id, $checked)) {
												echo '<li><input type="checkbox" class="filled-in" name="'.$term->slug.'[]" value="'.$child->term_id.'" id="'.$child->slug.'" checked><label for="'.$child->slug.'"> '.$child->name.'</label></li>';
											} else {
												echo '<li><input type="checkbox" class="filled-in" name="'.$term->slug.'[]" value="'.$child->term_id.'" id="'.$child->slug.'"><label for="'.$child->slug.'"> '.$child->name.'</label></li>';
											}											
										}
										echo '</ul>';
									}
									echo '</li>';
								}
							?>
						</ul>
						<div class="btn-apply">
							<button type="submit" class="button button--small" id="apply-filter">Apply Filter</button>
							<a href="<?php bloginfo( 'url' ); ?>/events/" class="button button--small reset-btn">Reset</a>
						</div>
                    </div>
                </div>
            </form>
			
			<div id="activities-feed">
				<?php 

				if (isset($_GET['people']) || isset($_GET['places']) || isset($_GET['culture']) || isset($_GET['government-institutions'])) {
					// rewind_posts();

					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

					$tax_query = array();

					// $tax_query = array(
					// 	'relation' => 'OR'
					// );

					// $people_arr = array(
					// 	'relation' => 'OR'
					// );

					// $places_arr = array(
					// 	'relation' => 'OR'
					// );

					// $culture_arr = array(
					// 	'relation' => 'OR'
					// );

					// $gov_arr = array(
					// 	'relation' => 'OR'
					// );

					$people  	= (isset($_GET['people'])) ? $_GET['people'] : 0;
					$places    	= (isset($_GET['places'])) ? $_GET['places'] : 0;
					$culture	= (isset($_GET['culture'])) ? $_GET['culture'] : 0;
					$gov     	= (isset($_GET['government-institutions'])) ? $_GET['government-institutions'] : 0;

					if($people) {
						foreach ($people as $value) {
							array_push($tax_query,$value);
						}
						
					}

					if($places) {
						foreach ($places as $value) {
							array_push($tax_query,$value);
						}
						
					}

					if($culture) {
						foreach ($culture as $value) {
							array_push($tax_query,$value);
						}
						
					}

					if($gov) {
						foreach ($gov as $value) {
							array_push($tax_query,$value);
						}	
					}

					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 17,
						// 'orderby' => 'modified',
						// 'order' => 'DESC',
						'paged' => $paged,
						'tax_query' => array(
							array(
								'taxonomy' => 'theme',
								'field'    => 'term_id',
								'terms'    => $tax_query
							),	
						),
					);

					// print_r($tax_query);

					$the_query = new WP_Query( $args );

				} else {
					// the Post query
					//Protect against arbitrary paged values
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
					$args = array(
						'post_type' => array('post'),
						'posts_per_page' => 30,
						'paged' => $paged,
						// 'nopaging' => true
					);
					$the_query = new WP_Query( $args ); 
				}
				?>
			
				<?php if ( $the_query->have_posts() ) : ?>
			
					<!-- pagination here -->
			
					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$tweetURL = get_post_meta( get_the_ID(), 'tweet_id', true);
						$random = rand(1,5);
						$specialCrop = wp_get_attachment_image( get_post_thumbnail_id( $post->ID ), 'event-card' );

						if ($specialCrop != false) {
							$eventCard = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'event-card' );
							// print_r($eventCard);
							// $thumbnail = get_the_post_thumbnail_url($post->ID, 'event-card' );
							$thumbnail = $eventCard[0];
							// print_r($eventCard);
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

		<!-- <div class="news-inner-wrapper" id="vue-news-container">
		</div> -->
		

   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->
<?php endwhile; endif;  ?>


<?php get_footer(); ?>