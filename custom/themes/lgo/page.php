<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post();

// Get meta content and assign to variable 
$group_values = rwmb_meta( 'accordion_content' ); ?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="parallax-container valign-wrapper">
		<div class="container">
			<div class="row">
				<div class="col s12 m8 offset-m2">
					<h1><?php the_title();?></h1>
				</div>
			</div>
		</div>
    	<div class="parallax overlay"><img src="<?php the_post_thumbnail_url(); ?>"></div>
    </div>
<?php elseif (!has_post_thumbnail() ) : ?>
	<h4><?php the_title();?></h4>
<?php endif; ?>


<section class="container section">
	<div class="row">
		<div class="col s12 m8 offset-m2">
	 		
            <?php the_content(); ?>

            <?php // Accordion
            	if ( ! empty( $group_values ) ) { ?>
				<ul class="collapsible" data-collapsible="accordion">
				<?php foreach ( $group_values as $group_value ) {
					$title 		= isset( $group_value['rw_title'] ) ? $group_value['rw_title'] : '';
					$content 	= wpautop(isset( $group_value['rw_content'] ) ? $group_value['rw_content'] : ''); ?>
    				<li>
      				<div class="collapsible-header"><i class="material-icons right">add_circle_outline</i><?php echo $title; ?></div>
      				<div class="collapsible-body"><span><?php echo $content; ?></span></div>
    				</li>
					<?php } //endforeach ?>
				</ul>
				<?php }; //endif !empty 
			// end accordion ?>
			
        </div>
    </div>
</section>

<?php endwhile; endif;  ?>
<?php get_footer(); ?>