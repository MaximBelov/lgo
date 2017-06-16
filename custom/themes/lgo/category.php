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
        <h1 class="search-result-text"><?php single_cat_title('Category: '); ?></h1>
        
    <div class="masonry-grid" id="activities-feed">
    <?php if(have_posts()): while(have_posts()): the_post(); 
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

        <a href="<?php the_permalink();?>" class="grid-item grid-item--2x2 wow fadeInUp" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);">
            <div class="grid-item--overlay"></div>
            <div class="grid-item__wrapper">
                <h3 class="grid-item--2x2--label"><?php the_title();?></h3>
            </div>
        </a>
    
    <?php endwhile; else: ?>
    <?php endif;  ?>
    </div>
    <div class="news-pagination"><?php echo paginate_links( $args ); ?></div>

        </div>
        
    </div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->


<?php get_footer(); ?>
