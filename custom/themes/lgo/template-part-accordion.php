<?php // Accordion
    $accordions = rwmb_meta( 'accordion_content' );
    // $test = $accordions[0]['rw_title'];

    if ( ! empty( $accordions) ) { 
        if (array_key_exists('rw_title' , $accordions[0] )) {
            $test = true;
        } else {
            $test = false;
        }
    }

    if ( ! empty( $accordions ) && $test == true ) { ?>
    <div class="js-accordion js-accordion-<?php echo $post->ID;?> js-acc--child-page" data-accordion-prefix-classes="acc-prefix-<?php echo $post->ID;?> animated-accordion">
    <?php foreach ( $accordions as $accordion ) {
        $title      = isset( $accordion['rw_title'] ) ? $accordion['rw_title'] : '';
        $content    = wpautop(isset( $accordion['rw_content'] ) ? $accordion['rw_content'] : ''); ?>
        <div class="js-accordion__panel">
            <h3 class="js-accordion__header"><?php echo $title;?></h3>
            <div class="js-accordion__content"><span><?php echo $content; ?></span></div>
        </div>
        <?php } //endforeach ?>
    </div>
    <?php }; //endif !empty 
?>