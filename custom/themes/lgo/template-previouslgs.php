<?php
/**
* Template Name: Previous LGs
*/
get_header();

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
$group_values = rwmb_meta( 'accordion_content' );
?>

<div class="left-panel__background" style="background-image: url(<?php echo get_template_directory_uri();?>/dist/images/music_room.jpg);">
</div>

<div class="right-panel right-panel--70">
<section class="page-previous-lgs fullscreen parallax-container valign-wrapper">
    <div class="container wow fadeIn" id="stats-trigger-large">
        <div class="row">
            <div class="col m12">
                <h1 class="headline"><?php the_title();?></h1>
            </div>
        </div>
    </div>
</section>

<section class="current-lg">
    <?php
     // Check if there are any team members
    $args = array(
        'post_type' => 'lg-list',
        'posts_per_page' => 1,
        'order' => 'DESC'
    );
    
    $loop = new WP_Query( $args );
    if ($loop->have_posts()){
        $count = 0;

    ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); 
            $role         = rwmb_meta( 'rw_tm_role' );
            $email         = rwmb_meta( 'rw_tm_email' );
            $count++;
            // print_r($count);
        ?>

        <?php if ($count == 1) { ?>

        <div class="single-lg--current">
          <div>
            <div data-modalnum="#modal<?php echo $count;?>" class="single-lg-portrait modal-trigger-general modal-trigger<?php echo $count;?>" style="background-image: url(<?php if (has_post_thumbnail()) { the_post_thumbnail_url( 'full' ); } else { echo 'http://placehold.it/500x500'; } ?> );">
              
            </div>
            <div class="single-lg-content">
              <p><?php the_title();?></p>
            </div>
          </div>
          <div id="modal<?php echo $count;?>" class="modal">
              <div class="modal-content">
                <?php the_content();?>
              </div>
              <div class="modal-footer">
                <a href="#!" class=" modal-close waves-effect btn-flat">Close</a>
              </div>
          </div>
        </div>

        <?php } ?>

        <?php endwhile; wp_reset_postdata(); ?>
    <?php } ?>
</section>

<section class="previous-lgs-list base-padding">
    <?php
     // Check if there are any team members
    $args = array(
        'post_type' => 'lg-list',
        'posts_per_page' => -1,
        'order' => 'DESC'
    );
    
    $loop = new WP_Query( $args );
    if ($loop->have_posts()){
        $count = 0;

    ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); 
            $role         = rwmb_meta( 'rw_tm_role' );
            $email         = rwmb_meta( 'rw_tm_email' );
            $count++;
            // print_r($count);
        ?>

        <?php if ($count !== 1) { ?>

        <div class="single-lg--former">
          <div>
            <div data-modalnum="#modal<?php echo $count;?>" class="single-lg-portrait modal-trigger-general modal-trigger<?php echo $count;?>">

              
            <image class="svg-clipped" href="<?php if (has_post_thumbnail()) { the_post_thumbnail_url( 'full' ); } else { echo 'http://placehold.it/200x200'; } ?>"/>

            
            <svg>
              <clipPath id="svgFramePath" clipPathUnits = "objectBoundingBox">
              <path d="M304.2,309.8 C304.2,309.8 296.9,312.5 296.5,322.8 C296.5,322.8 298,320.8 299.2,320.6 C299.2,320.6 294.8,326.1 296.4,334.4 C296.4,334.4 297.4,331.6 299.4,331.2 C299.4,331.2 295.1,338.8 293.8,341 C292.5,343.2 287.4,351.8 280,351 C280,351 285.9,355.9 283.9,359.6 C282.7,361.7 275.6,359.5 275.4,359.6 C275.4,359.6 282.2,366.1 278.3,371.6 C274.5,377 267.1,380.8 266.6,381.1 C266.7,380.9 268,379.3 268,379.2 C268,379.1 258.2,378.4 255.7,381.8 C255.8,381.6 256.7,379.8 256.7,379.8 C256.7,379.7 248.5,380.3 243.6,388.5 C243.6,388.5 232,395.7 218.6,381.1 C218.6,381.1 209.1,384.7 208.6,380 C208.6,380 212.8,379.7 213.5,375 C213.9,372.1 211.4,368.3 205.5,368.3 C198.7,368.3 194.4,374.7 194.5,381.1 C194.5,381.1 178.7,376.6 165.9,385.5 C165.9,385.5 160.1,381.9 152.7,381.9 L152.4,381.9 C144.9,381.9 139.1,386.4 139.1,386.4 C126.3,377.4 110.5,381.9 110.5,381.9 C110.6,375.5 106.3,369.1 99.5,369.1 C93.6,369.1 91.1,372.9 91.5,375.8 C92.2,380.5 96.4,380.8 96.4,380.8 C95.9,385.4 86.4,381.8 86.4,381.8 C73,396.4 61.4,389.2 61.4,389.2 C56.5,381 48.3,380.4 48.3,380.5 C48.3,380.6 49.2,382.3 49.3,382.5 C46.8,379.1 36.9,379.8 37,379.9 C37,380 38.3,381.6 38.4,381.7 C37.9,381.5 30.4,377.6 26.7,372.2 C22.8,366.6 29.6,360.1 29.6,360.1 C29.5,360 22.3,362.2 21.1,360.1 C19.1,356.4 25,351.6 25,351.6 C17.6,352.4 12.6,343.8 11.2,341.6 C9.9,339.4 5.6,331.8 5.6,331.8 C7.6,332.2 8.6,335 8.6,335 C10.1,326.8 5.8,321.2 5.8,321.2 C7,321.4 8.5,323.4 8.5,323.4 C8.2,313.1 0.8,310.4 0.8,310.4 C-2.7,289.4 11,285.4 11,285.4 C3.8,279.4 12.4,275.5 12.4,275.5 C11.8,278.5 13.4,279.6 13.4,279.6 C17.7,282.6 24,281.7 24.2,272.5 C24.4,263.3 14.8,262.4 14.8,262.4 C2.4,263.2 0.6,249.9 0.4,243.2 L0.5,243.2 L0.5,147.3 L0.4,147.3 C0.7,140.3 2.9,128.2 14.8,128.9 C14.8,128.9 24.4,128 24.2,118.8 C24,109.6 17.7,108.6 13.4,111.7 C13.4,111.7 11.7,112.7 12.4,115.8 C12.4,115.8 3.9,111.9 11,105.9 C11,105.9 -2.8,101.9 0.8,80.9 C0.8,80.9 8.2,78.2 8.5,67.9 C8.5,67.9 7,69.9 5.8,70.1 C5.8,70.1 10.2,64.6 8.6,56.3 C8.6,56.3 7.6,59.1 5.7,59.5 C5.7,59.5 10,51.9 11.3,49.7 C12.6,47.5 17.7,38.9 25.1,39.7 C25.1,39.7 19.2,34.8 21.2,31.2 C22.3,29.1 29.3,31.2 29.7,31.2 C29.4,30.9 23,24.6 26.8,19.1 C30.7,13.5 38.5,9.6 38.5,9.6 C38.5,9.6 37.1,11.4 37,11.5 C37,11.6 46.8,12.3 49.3,8.9 C49.2,9.1 48.3,10.9 48.3,10.9 C48.3,11 56.5,10.4 61.4,2.2 C61.4,2.2 72.9,-5 86.4,9.6 C86.4,9.6 95.9,6 96.4,10.6 C96.4,10.6 92.2,11 91.5,15.6 C91.1,18.5 93.6,22.3 99.5,22.3 C106.4,22.3 110.6,15.9 110.5,9.5 C110.5,9.5 126.3,14 139.1,5 C139.1,5 145,9.5 152.4,9.5 L152.7,9.5 C160.2,9.5 165.9,5.9 165.9,5.9 C178.7,14.9 194.5,10.4 194.5,10.4 C194.4,16.8 198.7,23.2 205.5,23.2 C211.4,23.2 213.9,19.4 213.5,16.5 C212.8,11.8 208.6,11.5 208.6,11.5 C209.1,6.9 218.6,10.4 218.6,10.4 C232,-4.2 243.6,3 243.6,3 C248.5,11.2 256.7,11.8 256.7,11.7 C256.7,11.6 255.8,9.9 255.7,9.7 C258.2,13.1 268,12.4 268,12.3 C268,12.2 266.6,10.4 266.6,10.4 C266.6,10.4 274.5,14.3 278.3,19.9 C282.1,25.3 275.7,31.6 275.4,31.9 C275.7,31.9 282.7,29.8 283.9,31.9 C285.9,35.6 280,40.4 280,40.4 C287.4,39.6 292.5,48.2 293.8,50.4 C295.1,52.6 299.5,60.2 299.5,60.2 C297.5,59.8 296.5,57 296.5,57 C295,65.2 299.3,70.8 299.3,70.8 C298.1,70.6 296.6,68.6 296.6,68.6 C296.9,78.9 304.3,81.6 304.3,81.6 C307.8,102.6 294.1,106.6 294.1,106.6 C301.3,112.6 292.7,116.5 292.7,116.5 C293.4,113.5 291.7,112.4 291.7,112.4 C287.4,109.4 281.1,110.3 280.9,119.6 C280.7,128.8 290.3,129.7 290.3,129.7 C301.6,129 304.2,140 304.6,147.1 L304.6,147.1 L304.6,238.3 L304.5,238.2 C304.5,238.2 304.5,238.5 304.6,239.1 L304.6,243 L304.6,243 C304.3,250 302.1,262 290.2,261.3 C290.2,261.3 280.6,262.2 280.8,271.4 C281,280.6 287.3,281.6 291.6,278.5 C291.6,278.5 293.3,277.5 292.6,274.4 C292.6,274.4 301.1,278.3 294,284.3 C294,284.8 307.7,288.8 304.2,309.8 Z"></path>
               </clipPath>
            </svg>
           
              
            </div>
            <div class="single-lg-content">
              <p><?php the_title();?></p>
            </div>
          </div>
          <div id="modal<?php echo $count;?>" class="modal">
              <div class="modal-content">
                <?php the_content();?>
              </div>
              <div class="modal-footer">
                <a href="#!" class=" modal-close waves-effect btn-flat">Close</a>
              </div>
          </div>
        </div>

        <?php } ?>

        <?php endwhile; wp_reset_postdata(); ?>
    <?php } ?>
</section>

<?php get_footer(); ?>