<?php
/**
* Social Share
* This creates a social share widget
*/
?>
<div class="social-share">
    <ul>
        <li><a target="_blank" title="Tweet" href="http://twitter.com/home?status=<?php echo get_the_title();?> @LGLizDowdeswell <?php echo get_the_permalink();?>" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a target="_blank" title="Share on Facebook" href="https://www.facebook.com/sharer.php?s=100&[title]=<?php echo get_the_title();?>&p[summary]=&p[url]=<?php echo get_the_permalink();?>&p[images][0]="><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="mailto:?subject=<?php echo get_the_title();?>&body=Check out this page from the website of The Lieutenant Governor of Ontario <?php echo get_the_permalink();?>" target="_blank" title="Share via email"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
        <li><a id="bookmark-social-share" href="" target="_blank" title="Add to bookmarks"><i class="fa fa-bookmark" aria-hidden="true"></i></a></li>
    </ul>
</div>