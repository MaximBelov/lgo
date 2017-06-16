<?php // photo
    $photos = rwmb_meta( 'gallery_content' );
    // print_r($photos);

    if ( ! empty( $photos) ) { 
        if (array_key_exists('rw_gal_title' , $photos[0] )) {
            $test = true;
        } else {
            $test = false;
        }
    }

    $total = count ( $photos );
    if ( ! empty( $photos) && $test == true) { 
    $count=1; ?>
    <div class="photo-gallery-container">
    <?php foreach ( $photos as $photo ) {
        $title      = isset( $photo['rw_gal_title'] ) ? $photo['rw_gal_title'] : '';
        $image = isset( $photo['rw_gal_photo'] ) ? $photo['rw_gal_photo'] : '';
        $content    = wpautop(isset( $photo['rw_gal_content'] ) ? $photo['rw_gal_content'] : ''); ?>
         
         <a href="#inline-<?php echo $count;?>" alt="<?php echo $title;?>" title="<?php echo $title;?>" data-lity><div style="background-image: url(<?php echo $image;?>);"></div></a>

         <div id="inline-<?php echo $count;?>" class="lity-hide">
             <img src="<?php echo $image;?>" alt="<?php echo $title;?>">
             <div class="gallery-lightbox-content">
                 <?php echo $content;?>
             </div>
         </div>
    <?php $count++;} //endforeach ?>
    </div> <!-- end of photo container -->

    <?php }; //endif !empty 
?>

