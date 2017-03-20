<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

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

<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s8 offset-s2">
                <h4><?php the_title();?></h4>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php endwhile; endif;  ?>
<?php get_footer(); ?>