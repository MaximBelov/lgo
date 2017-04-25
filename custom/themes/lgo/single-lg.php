<?php get_header(); ?>
<!--
<div class="left-panel__background" style="background-image: url(<?php echo get_template_directory_uri();?>/dist/images/installation_speech-splash.jpg);">
	
</div>
-->

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<div class="left-panel">

<section class="container base-padding no-pad-bottom">
	<div class="row">
		<div class="col s12">
			<h2><?php the_title();?></h2>
			<?php the_content(); ?>
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

<?php endwhile; endif;  ?>
<?php get_footer(); ?>