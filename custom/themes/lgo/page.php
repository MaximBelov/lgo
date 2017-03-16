<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): the_post(); 
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
?>


<div class="row">
    <div class="col m12" style="padding:0; margin-top: -80px;"">
        <div class="parallax-container valign-wrapper">
            <div class="container">
                <div class="row">
                    <h1 class="header col s12 light center"><?php the_title();?></h1>
                </div>
            </div>
            <div class="parallax overlay"><img src="<?php echo $thumbnail[0]; ?>"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s8 offset-s2">
                <h3><i class="mdi-content-send brown-text"></i></h3>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php endwhile; endif;  ?>
<?php get_footer(); ?>