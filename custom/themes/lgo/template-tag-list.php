<?php 
/**
* Template Name: Tag List
*/
get_header(); ?>

<?php get_template_part( 'template-part-nav' ); ?>

<?php if(have_posts()): while(have_posts()): the_post(); 
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

$cta_copy   = rwmb_meta( 'rw_cta_blurb' );
$cta_btns   = rwmb_meta( 'cta' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );
?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">

		<div class="news-inner-wrapper">
			<h1>Tags</h1>
			
			<ul class="tags-list">
				<?php
				$tags = get_tags();
				$html = '<div class="post_tags">';
				foreach ( $tags as $tag ) {
					$tag_link = get_tag_link( $tag->term_id );
							
					$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='tag-item-{$tag->slug}'>";
					$html .= "{$tag->name} ({$tag->count})</a></li>";
				}
				$html .= '</div>';
				echo $html;
				?>
			</ul>

		</div>
		

   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->
<?php endwhile; endif;  ?>


<?php get_footer(); ?>