<?php get_header();?>

    <div class="wapper">
      <div class="contentarea clearfix">
        <div class="content">
            <ul>
                <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <p><?php printf( __( 'Search Results for: %s', 'lgo' ), get_search_query() ); ?></p>
            </header><!-- .page-header -->

                        <?php
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                        ?>
                        <li><h3><a href="<?php get_the_permalink() ?>"><?php the_title(); ?></a></h3></li>
                        <?php the_post_thumbnail('medium') ?>
                        <?php echo substr(get_the_excerpt(), 0, 200); ?>
                            <div class="h-readmore"> 
                                <a href="<?php the_permalink(); ?>">Read More</a>
                            </div>
                        <?php
                        endwhile;
                else :
                // If no content, include the "No posts found" template.
                //get_template_part( 'content', 'none' );
                ?>       
            </ul>                                 

        </div>
      </div>
    </div>
<?php get_footer(); ?>
