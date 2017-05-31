<?php get_header(); ?>

<?php get_template_part( 'template-part-nav' ); ?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
    <div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
    </div>
    <div class="dark-overlay"></div>
    <div class="right-compartment">
        
        <div class="single-page__content">
        <h5>Search - <?php echo $wp_query->found_posts; ?> <?php _e( 'results for', 'locale' ); ?>: "<?php the_search_query(); ?>"</h5>
        <?php // Loop starts
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $s = get_search_query();
        $args = array(
            'paged' =>  $paged,
            's' => $s
        ); 

        $the_query = new WP_Query( $args ); 
    ?>

    <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

        <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
        <p><?php echo wp_trim_words( get_the_content(), 30, '...' );?><a href="<?php the_permalink(); ?>">read more</a></p>
    
    <?php endwhile; else: ?>

        <h4>No Results</h4>
        <p>Please feel free try again!</p>
       
    <?php endif;  ?>

    <?php //pagination(); ?>

        </div>
        
    </div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->


<?php get_footer(); ?>
