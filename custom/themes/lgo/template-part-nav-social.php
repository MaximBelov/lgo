<div class="nav-mailchimp">
	<?php 
	if(ICL_LANGUAGE_CODE=='fr'){ ?>
		<a href="http://eepurl.com/cUaOfT" target="_blank">S'abonner</a>
	<?php } else { ?>
		<a href="http://eepurl.com/cUaOfT" target="_blank">Subscribe</a>
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
    <li><a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank" title="Twitter" class="opens-in-new-window"><i class="fa fa-twitter" aria-hidden="true"></i><span class="hidden-element">Twitter</span><span class="new-window-box"><?php if(ICL_LANGUAGE_CODE=='fr'){ echo "S'ouvre dans un nouvel onglet"; } else { echo 'Opens in a new window'; }?></span></a></li>
    <li><a href="<?php echo $facebook; ?>" target="_blank" title="Facebook" class="opens-in-new-window"><i class="fa fa-facebook" aria-hidden="true"></i><span class="hidden-element" >Facebook</span><span class="new-window-box"><?php if(ICL_LANGUAGE_CODE=='fr'){ echo "S'ouvre dans un nouvel onglet"; } else { echo 'Opens in a new window'; }?></span></a></li>
    <li><a href="https://www.instagram.com/<?php echo $instagram; ?>" target="_blank" title="Instagram" class="opens-in-new-window"><i class="fa fa-instagram" aria-hidden="true"></i><span class="hidden-element">Instagram</span><span class="new-window-box"><?php if(ICL_LANGUAGE_CODE=='fr'){ echo "S'ouvre dans un nouvel onglet"; } else { echo 'Opens in a new window'; }?></span></a></li>
    <li><a href="<?php echo $youtube; ?>" target="_blank" title="Youtube" class="opens-in-new-window"><i class="fa fa-youtube-play" aria-hidden="true"></i><span class="hidden-element">Youtube</span><span class="new-window-box"><?php if(ICL_LANGUAGE_CODE=='fr'){ echo "S'ouvre dans un nouvel onglet"; } else { echo 'Opens in a new window'; }?></span></a></li>
</ul>