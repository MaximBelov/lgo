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
        <h1 class="search-result-text"><?php single_tag_title('Tagged: '); ?></h1>
        

    <?php if(have_posts()): while(have_posts()): the_post(); ?>

        <div class="search-results__single">
            <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <p><?php echo wp_trim_words( get_the_content(), 30, '...' );?><a href="<?php the_permalink(); ?>" class="read-more-link"><i class="fa fa-link" aria-hidden="true"></i></a></p>
        </div>
    
    <?php endwhile; else: ?>
    <?php endif;  ?>
    <div class="news-pagination"><?php echo paginate_links( $args ); ?></div>

        </div>
        
    </div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->


<?php get_footer(); ?>
