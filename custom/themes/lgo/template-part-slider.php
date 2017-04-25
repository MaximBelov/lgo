<?php // Slider
    $sliders = rwmb_meta( 'slider_content' );
    if ( ! empty( $sliders) ) { ?>
    <div class="js-slider">
    <?php foreach ( $sliders as $slider ) {
        $title      = isset( $slider['rw_stitle'] ) ? $slider['rw_stitle'] : '';
        $image = isset( $slider['rw_sphoto'] ) ? $slider['rw_sphoto'] : '';
        $content    = wpautop(isset( $slider['rw_scontent'] ) ? $slider['rw_scontent'] : ''); ?>
        <div class="js-slider__panel">
            <h3 class="js-slider__header"><?php echo $title;?></h3>
            <div class="js-slider__content"><span><?php echo $content; ?></span></div>
        </div>
        <?php } //endforeach ?>
    </div>
    <?php }; //endif !empty 
?>