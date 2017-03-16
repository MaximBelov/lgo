<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>

<header>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="brand-logo" src="<?php echo get_template_directory_uri();?>/dist/images/lgemblemwhite.svg"></a>
</header>

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