<?php get_header(); 
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

<?php get_template_part( 'template-part-nav' ); ?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
    <div class="left-compartment__bg" style="background-image: url(<?php echo get_template_directory_uri().$imgPath; ?>);">
    </div>
    <div class="dark-overlay"></div>
    <div class="right-compartment">
        
        <div class="single-page__content search-results-page">
        <h1 class="search-result-text"><?php echo $wp_query->found_posts; ?> 
            <?php 
            if(ICL_LANGUAGE_CODE=='fr'){ $resultTXT = 'résultats pour'; } else { echo 'results for'; }
            _e( $resultTXT, 'locale' ); ?>: "<?php the_search_query(); ?>"</h1>
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

        <div class="search-results__single">
            <p style="margin: 0;"><?php echo get_the_date('M j, Y', $post->ID); ?></p>
            <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php
            // Must be inside a loop.
            
            if ( has_post_thumbnail() ) {
                the_post_thumbnail();
            }
            else {
                echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
                    . '/images/thumbnail-default.jpg" />';
            }
            ?>
            <p><?php echo wp_trim_words( get_the_content(), 30, '...' );?><a href="<?php the_permalink(); ?>" class="read-more-link"><i class="fa fa-link" aria-hidden="true"></i></a></p>
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

        </div>
        
    </div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->


<?php get_footer(); ?>
