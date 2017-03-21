<?php
/**
* Template Name: Previous LGs
*/
get_header();

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
$group_values = rwmb_meta( 'accordion_content' );
?>

<section class="about-page fullscreen parallax-container valign-wrapper">
    <div class="container wow fadeIn" id="stats-trigger-large">
        <div class="row">
            <div class="col m12">
                <h1 class="headline"><?php echo $heading;?></h1>
                <h2 class="subheadin thin" id="stats-trigger"><?php echo $subhead;?></h2>
            </div>
        </div>
    </div>
</section>


<section class="previous-lgs-list container">
    <div class="row">
      
      <?php // Accordion
              if ( ! empty( $group_values ) ) { ?>
        <?php foreach ( $group_values as $group_value ) { ?>
          <div class="col s12 m3">
            <div>
              <p>Insert Name Here</p>
            </div>
          </div>
          <?php } //endforeach ?>
        <?php }; //endif !empty 
      // end accordion ?>

      
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
      <div class="col s12 m3">
        <div>
          <p>Insert Name Here</p>
        </div>
      </div>
    </div>
</section>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>