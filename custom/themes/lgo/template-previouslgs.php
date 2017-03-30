<?php
/**
* Template Name: Previous LGs
*/
get_header();

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
$group_values = rwmb_meta( 'accordion_content' );
?>

<section class="page-previous-lgs fullscreen parallax-container valign-wrapper">
    <div class="container wow fadeIn" id="stats-trigger-large">
        <div class="row">
            <div class="col m12">
                <h1 class="headline"><?php the_title();?></h1>
            </div>
        </div>
    </div>
</section>


<section class="previous-lgs-list container base-padding">
    <div class="row">

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

        <?php if ($count == 1) { ?>

        <div class="col s12 m6">
          <div>
            <div class="single-lg-portrait" style="background-image: url(<?php if (has_post_thumbnail()) { the_post_thumbnail_url( 'full' ); } else { echo 'http://placehold.it/500x500'; } ?> );">
              
            </div>
            <div class="single-lg-content">
              <p><?php the_title();?></p>
              <a class="modal-trigger-general modal-trigger<?php echo $count;?> btn pc-blue no-shadow" href="#modal<?php echo $count;?>">Bio</a>
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

        <?php } else { ?>

        <div class="col s12 m3">
          <div>
            <div class="single-lg-portrait" style="background-image: url(<?php if (has_post_thumbnail()) { the_post_thumbnail_url( 'full' ); } else { echo 'http://placehold.it/500x500'; } ?> );"></div>
            <div class="single-lg-content">
              <p><?php the_title();?></p>
              <a class="modal-trigger-general modal-trigger<?php echo $count;?> btn pc-blue no-shadow" href="#modal<?php echo $count;?>">Bio</a>
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
    </div>
</section>

<?php get_footer(); ?>