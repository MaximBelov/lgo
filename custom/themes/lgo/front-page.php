<?php get_header(); ?>

<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container wow fadeIn">
            <div class="col s12 center">
                <h1>Revive Engineering works in partnership with architects, designers, and builders offering structural engineering solutions.</h1>
                <br>
                <a href="#contact" class="button-custom">Let's Work Together</a> 
            </div>
        </div>
    </div>
    <div class="parallax overlay"><img src="<?php echo get_home_url(); ?>/custom/uploads/2017/01/boys-1149665_1280.jpg"></div>
</div>

<!-- ABOUT STARTS -->
<section id="about" class="scrollspy">
    <?php
        $post_id = 7;
        $queried_post = get_post($post_id);
        $title = $queried_post->post_title;
        $content  = wpautop($queried_post->post_content);
    ?>
    <div class="container" >
        <div class="row section ">
            <div class="col s12 m10 offset-m1 about">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <?php
    $args = array(
        'post_type' => 'testimonials',
        'orderby' => 'rand',
        'posts_per_page' => 1,
        );

    query_posts($args); ?>

    <div class="parallax-container valign-wrapper" style=" min-height: 500px;">
    <div class="section no-pad-bot">
            <div class="container">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
                <blockquote>
                    <?php echo the_content();?>
                </blockquote>
                <span class="right"> - <?php echo the_title();?></span>

                <?php endwhile; endif; ?>
                <?php rewind_posts(); ?>
            </div>
        </div>
        <div class="parallax overlay"><img src="<?php echo get_home_url(); ?>/custom/uploads/2016/12/tree-trunks-1535531_1280-1200x800.jpg"></div>
    </div>
</section>

<!-- SERVICES START -->
<section id="services" class="row scrollspy">
    <?php
    $args1 = array(
        'post_type' => 'service',
        'orderby'   => 'menu_order',
        'order'     => 'ASC',
        );

    query_posts($args1); ?>

    <div class="col s12">
        <div class="flex-grid">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
            $content = get_the_content();
            $excerpt = get_the_excerpt();
        ?>
        <div class="flex-item">
            <h4 class="center"><?php echo the_title();?></h4>
            <p class="large-font"><?php echo $content;?></p>
        </div>
        <?php endwhile; endif; ?>
        </div>
    </div>
</section>

<!-- TEAM STARTS -->
<section id="team" class="scrollspy">
    <?php
    $args2 = array(
        'post_type' => 'team',
        'order'   => 'DESC',
        );

    query_posts($args2); ?>

    <div class="container">
        <div class="row section no-pad-bottom">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                $content   = get_the_content();
                $creds = rwmb_meta( 'rw_creds' );
                $role = rwmb_meta( 'rw_role' );
                $linkedin = rwmb_meta( 'rw_linkedin' );
            ?>
            <div class="col s12 m6">
            <div class="team">
                <div class="center">
                    <img class="circle esponsive-img avatar" src="<?php the_post_thumbnail_url(); ?>"/>
                </div>
                <h3><?php echo the_title();?><span class="creds"><?php echo $creds; ?></span></h3>
                <p><?php echo $role;?>
                <?php if($linkedin) : ?>
                | <a href="<?php echo $linkedin;?>" target="blank">Linkedin</a></p>
            <?php endif ?>
                <p class="large-font"><?php echo $content;?></p>
            </div>      
            </div>
            <?php endwhile; endif; ?>
        </div>   
    </div>
</section>

<!-- LET'S WORK TOGETHER STARTS -->
<section id="contact" class="scrollspy">
    <div class="container" style="padding-bottom: 2em;">
        <div class="row section no-pad-bottom">
            <div class="col s12 m8 offset-m2 white-text ">
                <h2 class="center">Let's Work Together</h2>
                <div role="form" class="wpcf7" id="wpcf7-f51-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <form action="/#wpcf7-f51-o1" method="post" class="wpcf7-form" novalidate="novalidate">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="51" />
                            <input type="hidden" name="_wpcf7_version" value="4.6" />
                            <input type="hidden" name="_wpcf7_locale" value="en_US" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f51-o1" />
                            <input type="hidden" name="_wpnonce" value="e57ab8e6e8" />
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="name">Name</label><br />
                                <input type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required" aria-required="true" aria-invalid="false" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="email">Email</label><br />
                                <input type="email" name="your-email" value="" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="your-message">Your Message</label><br />
                                <textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea materialize-textarea" id="textarea1" aria-invalid="false"></textarea>
                            </div>
                        </div>
                        <p><input type="submit" value="Let&#039;s Talk" class="button-form right" /></p>
                        <div class="wpcf7-response-output wpcf7-display-none"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>