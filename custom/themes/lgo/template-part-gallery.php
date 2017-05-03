<?php 
/**
* Gallery Template Part
*/
?>

<div id="columns">
  
<?php $args = array(
    'post_type' => 'lg',
    'posts_per_page' =>100,
    'orderby' => 'menu_order', 
    'order' => 'DESC'
    );

    $loop = new WP_Query($args); ?>

    <?php while($loop->have_posts()) : $loop->the_post();
?>

<figure class="element">
    <a href="<?php echo the_permalink();?>"><img src="<?php the_post_thumbnail_url(); ?>"></a>
    <figcaption><a href="<?php echo the_permalink();?>"><?php echo the_title();?></a></figcaption>
</figure>
<?php endwhile; ?>

</div>
