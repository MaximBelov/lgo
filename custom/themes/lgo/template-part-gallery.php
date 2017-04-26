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
    'order' => 'ASC'
    );

    $loop = new WP_Query($args); ?>

    <?php while($loop->have_posts()) : $loop->the_post();
?>

<figure class="element">
    <img src="<?php the_post_thumbnail_url(); ?>">
    <figcaption><?php echo the_title();?></figcaption>
</figure>
<?php endwhile; ?>

</div>
