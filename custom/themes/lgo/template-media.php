<?php 
/**
* Template Name: Media
*/
get_header(); ?>

<?php get_template_part( 'template-part-nav' ); ?>

<?php if(have_posts()): while(have_posts()): the_post(); 
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

$cta_copy   = rwmb_meta( 'rw_cta_blurb' );
$cta_btns   = rwmb_meta( 'cta' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">

		    <div class="single-page__content search-results-page media-template">
		    <h1>Media</h1>
		    <?php // Loop starts
		    $args = array(
		    	'post_type' => array('post'),
		    	'posts_per_page' => 30,
		    	'tag' => 'media'
		    	// 'nopaging' => true
		    );

		    $the_query = new WP_Query( $args ); 
		?>

		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		    <div class="search-results__single">
		        <h2 class="search-results__heading"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?> <span>(<?php if(ICL_LANGUAGE_CODE=='fr'){ ?><?php the_time('j F Y'); ?><?php } else { ?><?php the_time('F j, Y'); ?><?php } ?>)</span></a></h2>
		    </div>
		
		<?php endwhile; else: ?>

		    <?php 
		    if(ICL_LANGUAGE_CODE=='fr'){ 
		        $another = 'Essayez une autre recherche'; 

		    } else { 
		        $another = 'Please try another search.';
		    } ?>
		    <p><?php echo $another;?></p>
		   
		<?php endif;  ?>

		<?php //pagination(); ?>
		<div class="search-pagination"><?php echo paginate_links( $args ); ?></div>

		

   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->
<?php endwhile; endif;  ?>


<?php get_footer(); ?>
