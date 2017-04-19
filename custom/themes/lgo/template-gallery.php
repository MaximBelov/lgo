<?php 
/**
* Template Name: Gallery
*/
get_header(); ?>

<div id="columns">
  <figure>
  <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/cinderella.jpg">
	<figcaption>Cinderella wearing European fashion of the mid-1860’s</figcaption>
	</figure>
	
	<figure>
	<img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/rapunzel.jpg">
	<figcaption>Rapunzel, clothed in 1820’s period fashion</figcaption>
	</figure>
	
  <figure>
	<img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/belle.jpg">
	<figcaption>Belle, based on 1770’s French court fashion</figcaption>
	</figure>
  
	<figure>
	<img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/mulan_2.jpg">
	<figcaption>Mulan, based on the Ming Dynasty period</figcaption>
	</figure>
	
   <figure>
	 <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/sleeping-beauty.jpg">
	<figcaption>Sleeping Beauty, based on European fashions in 1485</figcaption>
	</figure>
	
   <figure>
	 <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/pocahontas_2.jpg">
	<figcaption>Pocahontas based on 17th century Powhatan costume</figcaption>
	</figure>
  
	<figure>
	<img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/snow-white.jpg">
	<figcaption>Snow White, based on 16th century German fashion</figcaption>
	</figure>	
  
   <figure>
	<img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/ariel.jpg">
	<figcaption>Ariel wearing an evening gown of the 1890’s</figcaption>
	</figure>
  
    <figure>
	<img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/4273/tiana.jpg">
    <figcaption>Tiana wearing the <i>robe de style</i> of the 1920’s</figcaption>
	</figure>	
  <small>Art &copy; <a href="//clairehummel.com">Claire Hummel</a></small>
	</div>

<?php $args = array(
    'post_type' => 'lg-list',
    'posts_per_page' =>100,
    'orderby' => 'title', 
    'order' => 'ASC'
    );

    $loop = new WP_Query($args); ?>

    <?php while($loop->have_posts()) : $loop->the_post();

    $job_title          = get_post_meta($post->ID,'_team_title',true);
    $email              = get_post_meta($post->ID,'_team_email',true);
    $phone              = get_post_meta($post->ID,'_team_phone',true);
    $bio                = wpautop(get_post_meta($post->ID,'_team_bio',true));
    $team_image_id      = get_post_meta($post->ID,'_team_image', true);
    $team_image_url     = wp_get_attachment_image_src($team_image_id,'medium', true); ?>

    <img style="width: 100px" src="<?php the_post_thumbnail_url(); ?>"/>
<h3><?php echo the_title();?></h3>
<?php //echo the_content();?>

<?php endwhile; ?>
<?php get_footer(); ?>