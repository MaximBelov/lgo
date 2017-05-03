<?php get_header(); ?>

<?php get_template_part( 'template-part-nav-narrow' ); ?>

<?php if(have_posts()): while(have_posts()): the_post(); 
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-lg">

	<div class="left-panel" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);background-size: cover;">
	</div><div class="right-panel">
		<a href="#" class="frame-btn" style="background-image:url(<?php echo get_template_directory_uri().'/src/images/button-frame.png';?>);">
			Gallery
		</a>
		<div class="single-lg__content">

			<h2><?php the_title();?></h2>
			<?php the_content(); ?>

			<div class="single-lg__prev-next-links">

				<div class="single-lg__prev-link">
					<svg width="21px" height="15px" viewBox="0 0 21 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					    <!-- Generator: Sketch 43.1 (39012) - http://www.bohemiancoding.com/sketch -->
					    <desc>Created with Sketch.</desc>
					    <defs></defs>
					    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					        <g id="Desktop" transform="translate(-621.000000, -592.000000)" fill="#214ab7">
					            <path d="M642.025825,599.67788 C642.025825,599.499078 641.914247,599.262217 641.802669,599.148154 L635.457007,592.597228 C635.161934,592.300253 634.680192,592.265829 634.335411,592.566914 C634.027647,592.8382 634.019186,593.363815 634.304212,593.65668 L639.398192,598.907183 L622.195631,598.907183 C621.75778,598.907183 621.402423,599.252455 621.402423,599.67788 C621.402423,600.103305 621.75778,600.448577 622.195631,600.448577 L639.398192,600.448577 L634.304212,605.69908 C634.019186,605.991945 634.039809,606.505743 634.335411,606.788846 C634.647406,607.087877 635.165635,607.061673 635.457007,606.758532 L641.802669,600.207606 C641.988809,600.029318 642.02371,599.858737 642.025825,599.67788 Z" id="Page-1" transform="translate(631.714124, 599.678571) scale(-1, 1) translate(-631.714124, -599.678571) "></path>
					        </g>
					    </g>
					</svg>
					<?php previous_post_link('%link'); ?>
				</div>
				<div class="single-lg__next-link">
					<?php next_post_link('%link'); ?>
					<svg width="21px" height="15px" viewBox="0 0 21 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					    <!-- Generator: Sketch 43.1 (39012) - http://www.bohemiancoding.com/sketch -->
					    <desc>Created with Sketch.</desc>
					    <defs></defs>
					    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					        <g id="Desktop" transform="translate(-917.000000, -620.000000)" fill="#214ab7">
					            <path d="M938.025825,627.67788 C938.025825,627.499078 937.914247,627.262217 937.802669,627.148154 L931.457007,620.597228 C931.161934,620.300253 930.680192,620.265829 930.335411,620.566914 C930.027647,620.8382 930.019186,621.363815 930.304212,621.65668 L935.398192,626.907183 L918.195631,626.907183 C917.75778,626.907183 917.402423,627.252455 917.402423,627.67788 C917.402423,628.103305 917.75778,628.448577 918.195631,628.448577 L935.398192,628.448577 L930.304212,633.69908 C930.019186,633.991945 930.039809,634.505743 930.335411,634.788846 C930.647406,635.087877 931.165635,635.061673 931.457007,634.758532 L937.802669,628.207606 C937.988809,628.029318 938.02371,627.858737 938.025825,627.67788 Z" id="Page-1"></path>
					        </g>
					    </g>
					</svg>
				</div>
			</div>
		</div>
	</div>
	
</div>

<?php endwhile; endif;  ?>

<?php get_footer(); ?>