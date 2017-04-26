<?php get_header(); ?>

<?php get_template_part( 'template-part-nav-narrow' ); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<div class="full-width-panel">

	<div class="left-panel">
	
	<section class="container base-padding no-pad-bottom">
		<div class="row">
			<div class="col s12">
				
			</div>
		</div>
	</section>
	</div>
	
	<div class="right-panel">
	
	<section class="container base-padding no-pad-bottom">
		<div class="row">
			<div class="col s12">
				<h2><?php the_title();?></h2>
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	
</div>

<?php endwhile; endif;  ?>

<?php get_footer(); ?>