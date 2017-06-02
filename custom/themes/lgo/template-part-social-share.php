<?php
/**
* Social Share
* This creates a social share widget
*/
if(get_option('lgo_option_name')){
    $options = get_option( 'lgo_option_name' );
} else {
	$options = array(
		"lgo_twitter" => "twitterusername",
		"lgo_facebook" => "facebooklink",
		"lgo_instagram" => "instagramusername",
		"lgo_youtube" => "youtubelink"
	);
}
$twitter = $options['lgo_twitter'];
$facebook = $options['lgo_facebook'];
$instagram = $options['lgo_instagram'];
$youtube = $options['lgo_youtube'];
$cleanTitle = strip_tags(get_the_title());
?>
<div class="social-share">
    <ul>
        <li id="twitter-social-share" data-twitter-user="<?php echo $twitter; ?>"><a target="_blank" title="Tweet" href="http://twitter.com/home?status=<?php echo $cleanTitle;?> @<?php echo $twitter; ?> <?php echo get_the_permalink();?>" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a target="_blank" title="Share on Facebook" href="https://www.facebook.com/sharer.php?s=100&[title]=<?php echo $cleanTitle;?>&p[summary]=&p[url]=<?php echo get_the_permalink();?>&p[images][0]="><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="mailto:?subject=<?php echo $cleanTitle;?>&body=Check out this page from the website of The Lieutenant Governor of Ontario <?php echo get_the_permalink();?>" target="_blank" title="Share via email"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
    </ul>
</div>