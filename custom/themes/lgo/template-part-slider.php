<?php // Slider
    $sliders = rwmb_meta( 'slider_content' );

    if ( ! empty( $sliders) ) { 
        if (array_key_exists('rw_stitle' , $sliders[0] )) {
            $test = true;
        } else {
            $test = false;
        }
    }

    $total = count ( $sliders );
    if ( ! empty( $sliders) && $test == true) { 
    $count=1; ?>
    <div class="slideshow-container">
    <?php foreach ( $sliders as $slider ) {
        $title      = isset( $slider['rw_stitle'] ) ? $slider['rw_stitle'] : '';
        $image = isset( $slider['rw_sphoto'] ) ? $slider['rw_sphoto'] : '';
        $content    = wpautop(isset( $slider['rw_scontent'] ) ? $slider['rw_scontent'] : ''); ?>
         <div class="mySlides fade">
            <div class="js-slider__image">
                <img src="<?php echo $image;?>" alt="<?php echo $title;?>">
                <div class="numbertext"><?php echo $count;?> / <?php echo $total;?></div>
            </div>
            <div class="js-slider__content">
                <h3 class="js-slider__header"><?php echo $title;?></h3>
                <div><?php echo $content; ?></div>
            </div>
        </div>
    <?php $count++;} //endforeach ?>
        <a class="prev-s">&#10094;</a>
        <a class="next-s">&#10095;</a>
    </div> <!-- end of slider container -->

    <div style="text-align:center">
    <?php 
    $countTwo=1;
    foreach ( $sliders as $slider ) { ?>
          <span class="dot" onclick="currentSlide(<?php echo $countTwo;?>)"></span>  
    <?php $countTwo++;} ?>
    </div>

    <?php }; //endif !empty 
?>

