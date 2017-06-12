<ul class="nav-social">
	<?php
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
	?>
    <li><a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank" alt="Twitter" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
    <li><a href="<?php echo $facebook; ?>" target="_blank" alt="Facebook" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
    <!-- <li><a href="https://www.instagram.com/<?php //echo $instagram; ?>" target="_blank" alt="Instagram" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li> -->
    <li><a href="<?php echo $youtube; ?>" target="_blank" alt="Youtube" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
</ul>
<div class="nav-mailchimp">
	<a href="#">Sign up for updates</a>
</div>