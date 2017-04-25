<?php 
/**
* Template Name: Gallery
*/
get_header(); ?>

<div id="columns">
  
<?php $args = array(
    'post_type' => 'lg',
    'posts_per_page' =>100,
    'orderby' => 'title', 
    'order' => 'ASC'
    );

    $loop = new WP_Query($args); ?>

    <?php while($loop->have_posts()) : $loop->the_post();

    //$job_title          = get_post_meta($post->ID,'_team_title',true);  
    //$team_image_id      = get_post_meta($post->ID,'_team_image', true);
    //$team_image_url     = wp_get_attachment_image_src($team_image_id,'medium', true); ?>

<figure class="element">
  	<img src="<?php the_post_thumbnail_url(); ?>">
	<figcaption><?php echo the_title();?></figcaption>
</figure>
<?php endwhile; ?>

</div>
<?php get_footer(); ?>