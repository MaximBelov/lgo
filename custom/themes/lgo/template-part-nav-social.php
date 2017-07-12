<div class="nav-mailchimp">
	<?php 
	if(ICL_LANGUAGE_CODE=='fr'){ ?>
		<a href="http://eepurl.com/cUaOfT">S'abonner</a>
	<?php } else { ?>
		<a href="http://eepurl.com/cUaOfT">Subscribe</a>
	<?php } ?>
</div>
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
    <li><a href="http://twitter.com/<?php echo $twitter; ?>" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
    <li><a href="<?php echo $facebook; ?>" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span class="hidden-element" >Facebook</span></a></li>
    <li><a href="https://www.instagram.com/<?php echo $instagram; ?>" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i><span class="hidden-element">Instagram</span></a></li>
    <li><a href="<?php echo $youtube; ?>" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i><span class="hidden-element">Youtube</span></a></li>
</ul>