<?php 
/**
* Template Name: Parent Page
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );


if (wp_is_mobile()) {
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); 
} else {
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
}

$sidebar   = rwmb_meta( 'rw_banner_sidebar_bg' );
$accordions = rwmb_meta( 'accordion_content' );

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

if(ICL_LANGUAGE_CODE=='fr'){
	$pid = icl_object_id($post->ID,'page',false,'en');
} else {
	$pid = icl_object_id($post->ID,'page',false,'fr');
}

// print_r($pid);
$pslug = get_post_field( 'post_name', $pid );
// print_r($pslug);

?>

<?php get_template_part( 'template-part-nav' ); ?>

<div id="scroll-header" class="top-page-panel parent-template" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);" data-twpml-slug="<?php echo $pslug;?>">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<h1><span><?php if($heading) { echo $heading; } else {echo get_the_title();} ?></span></h1>
			<div class="separator"></div>
			<div class="home-subhead">
				<?php echo $subhead;?>
			</div>
			<a href="#skip-to-content"><svg width="16px" height="29px" viewBox="0 0 16 29" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <desc>Scroll Down</desc>
				    <defs></defs>
				    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g id="home" transform="translate(-537.000000, -609.000000)" fill="#ffffff">
				            <path d="M559.160469,623.320737 C559.160469,623.141936 559.008113,622.905075 558.855758,622.791011 L550.190998,616.240085 C549.788087,615.94311 549.130287,615.908686 548.659502,616.209771 C548.239261,616.481057 548.227708,617.006672 548.6169,617.299537 L555.572536,622.55004 L532.083095,622.55004 C531.485227,622.55004 531,622.895312 531,623.320737 C531,623.746162 531.485227,624.091434 532.083095,624.091434 L555.572536,624.091434 L548.6169,629.341937 C548.227708,629.634802 548.255869,630.1486 548.659502,630.431703 C549.085519,630.730734 549.793142,630.70453 550.190998,630.401389 L558.855758,623.850463 C559.109924,623.672175 559.15758,623.501594 559.160469,623.320737 Z" id="Page-1" transform="translate(545.080234, 623.321429) scale(-1, 1) rotate(90.000000) translate(-545.080234, -623.321429) "></path>
				        </g>
				    </g>
				</svg></a>
		</div>
	</div>
</div>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed <?php if (is_page_template( 'template-parent-page.php')) { echo 'parent-page-layout'; }?>">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($sidebar) { ?><?php echo $sidebar; ?><?php } else { echo get_template_directory_uri().$imgPath; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">

		<?php
		if( get_post()->post_content !== '' || ! empty( $accordions) ) { ?>
			<div class="parent-page-content">
			<?php the_content(); ?>

			<?php get_template_part( 'template-part-accordion' ); ?>

			<?php get_template_part( 'template-part-slider' ); ?>
			</div>
		<?php } ?>

		<?php
		$theID = get_the_ID();
		// print_r($theID);
		$args = array(
			'post_type'      => 'page',
			'post_parent' => $theID,
		    'order' => 'ASC',
		    'orderby' => 'menu_order'
		);
		// The Query
		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post(); 

			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' );

			if(ICL_LANGUAGE_CODE=='fr'){
				$tid = icl_object_id($post->ID,'post',false,'en');
				$tslug = get_post_field( 'post_name', $tid );
			} else {
				$tid = icl_object_id($post->ID,'post',false,'fr');
				$tslug = get_post_field( 'post_name', $tid );
			}

			?>

			<div class="preload-background" style="background-image: url(<?php echo $thumb[0];?>);"></div>

			<?php //echo $tslug;?>			

			<?php if ($post->ID == 15 || $post->ID == 448 ) { ?>

			<div id="<?php echo $post->post_name;?>" class="child-page-section child-page child-page-<?php echo $post->ID;?>" data-child-id="<?php echo $post->ID;?>" data-child-bg="<?php echo $thumb[0];?>" data-child-slug="<?php echo $tslug;?>">
				<?php
				if ( current_user_can('administrator') ) { ?>
					<a href="<?php echo get_edit_post_link( $post->ID );?>" class="btn btn--accent" id="edit-child-section">Edit</a>
				<?php } ?>
		        <div class="child-page-content">
		    		<h2 class="child-title"><?php echo $post->post_title; ?></h2>

		        	<?php the_content(); ?>
					
					    <?php
						if ( current_user_can('administrator') ) { ?>
							<a href="<?php echo get_edit_post_link( $post->ID );?>" class="btn btn--accent" id="edit-gallery-section">View LG List</a>
						<?php } ?>
		        </div>
			    
			    <?php get_template_part( 'template-part-gallery' ); ?>
			</div>

			<?php } else { ?>
			
			<div id="<?php echo $post->post_name;?>" class="child-page-section child-page child-page-<?php echo $post->ID;?>" data-child-id="<?php echo $post->ID;?>" data-child-bg="<?php echo $thumb[0];?>" data-child-slug="<?php echo $tslug;?>">
				<?php
				if ( current_user_can('administrator') ) { ?>
					<a href="<?php echo get_edit_post_link( $post->ID );?>" class="btn btn--accent" id="edit-child-section">Edit</a>
				<?php } ?>
			    <div class="child-page-content"> 
					<h2 class="child-title"><?php echo $post->post_title; ?></h2>

			    	<?php the_content(); ?>

		    	<?php get_template_part( 'template-part-accordion' ); ?>

		    	<?php get_template_part( 'template-part-slider' ); ?>
				
				<?php if ($post->ID == 60) { ?>
					<?php gravity_form(2, false, false, false, '', true, 12);?>
				<?php } ?>

			    </div>
			</div>

			<?php } ?>

		<?php }
			wp_reset_postdata();
		} else { ?>
		<?php } ?>
   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->
<?php get_footer(); ?>