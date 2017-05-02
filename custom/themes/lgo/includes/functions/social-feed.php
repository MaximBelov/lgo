<?php
// require get_template_directory().'/includes/library/facebook/facebook.php';

function featuredtoRSS($content) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){
	$content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'float:left; margin:5px 15px 20px 0px;' ) ) . '' . $content;
	}
	return $content;
}

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');

function array_multi_unique($multiArray){
  $uniqueArray = array();
  foreach($multiArray as $subArray){
    if(!in_array($subArray, $uniqueArray)){
      $uniqueArray[] = $subArray;
    }
  }
  return $uniqueArray;
}

// function fetch_facebook_feed() {
// 	// Create our Application instance (replace this with your appId and secret).
// 	$facebook = new Facebook(array(
// 	  'appId'  => '949341928475039',
// 	  'secret' => '597f2f1a290f82ef65abbc2b2c325cf6',
// 	));
// 	$feeds=$facebook->api('199899653356651/feed?fields=picture,object_id,type,created_time,message,link,from,name,icon');
// 	$i = 0;
// 	// print_r($feeds);
// 	foreach($feeds['data'] as $post) {
// 		if($post['type']=='photo') {
// 			$object_id = $post['object_id'];
// 			$img ='https://graph.facebook.com/'.$object_id.'/picture?width=9999&height=9999';
// 			$date = date("d-m-Y H:i:s", strtotime($post['created_time']));
// 			$title = $post['message'];
// 			$link = $post['link'];
// 			$author=$post['from']['name'];
// 			$results[]=array('title'=>$title,'author'=>$author,'link'=>$link,'img'=>$img,'date'=>$date,'label'=>'facebook','filter'=>'social');
// 			$i++; // add 1 to the counter
// 		} else {
// 			$object_id = $post['object_id'];
// 			$img =$post['picture'];
// 			$date = date("d-m-Y H:i:s", strtotime($post['created_time']));
// 			$title = $post['message'];
// 			$link = $post['link'];
// 			$author=$post['from']['name'];
// 			$results[]=array('title'=>$title,'author'=>$author,'link'=>$link,'img'=>$img,'date'=>$date,'label'=>'facebook','filter'=>'social');
// 			$i++; // add 1 to the counter
// 		}
// 		//  break out of the loop if counter has reached 10
// 		if ($i == 10) {
// 			break;
// 		}
// 	}
// 	return array_multi_unique($results);
// }

function fetch_twitter_feed() {
	// Set here your twitter application tokens
	$settings = array(
	    'oauth_access_token' => "16689920-YVf29NrOQi3JqFI63TD0nvOhP3A4cLtAZWu2MBjJH",
	    'oauth_access_token_secret' => "LUtvdM5ZpKU89gja9DayOLOcsHmtqcrq7G7IAckzt3nMx",
	    'consumer_key' => "U5BM089jNyV3M2VMP7SBkpRht",
	    'consumer_secret' => "uzs5pzHfx0uEknLzh969EGDNcY31letfCA78vVjKoylxNRXZrZ"
	);

	// Get timeline using TwitterAPIExchange
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=hypenotic&exclude_replies=true';
	$requestMethod = 'GET';

	$twitter = new TwitterAPIExchange($settings);
	$user_timeline = $twitter
	  ->setGetfield($getfield)
	  ->buildOauth($url, $requestMethod)
	  ->performRequest();

	$user_timeline = json_decode($user_timeline, true);

	$result=$user_timeline;
	// print_r($user_timeline);
	// $results='';
	$img='';
	$date='';
	$id='';
	$total_feeds=count($result);	
	if($total_feeds>0) {
		for($i=0;$i<$total_feeds;$i++) {
			$img = $result[$i]['user']['profile_background_image_url'];
			$date = date("d-m-Y H:i:s", strtotime($result[$i]['created_at']));
			$title = $result[$i]['text'];
			$fulllink = "https://twitter.com/hypenotic/status/".$result[$i]['id_str'];
			$author=$result[$i]['user']['name'];
			$results[]=array('title'=>$title,'author'=>$author,'link'=>$fulllink,'img'=>$img,'date'=>$date,'label'=>'twitter','filter'=>'social');
		}
	}
	// print_r('-------------');
	// print_r($results);
	return $results;
	// show_twit_results($results);
}

// function fetch_instagram_feed($url) {
// 	$ch = curl_init($url); 
// 	 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); 
// 	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
// 	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
// 		$json = curl_exec($ch); 
// 		$data=json_decode($json, true);
// 		$result=$data['data'];
// 		$results='';
// 		$img='';
// 		$date='';
// 		$total_feeds=count($result);	
// 		if($total_feeds>0) {
// 			for($i=0;$i<$total_feeds;$i++) {
// 				$img = $result[$i]['images']['standard_resolution']['url'];
// 				$date = date("d-m-Y H:i:s", $result[$i]['created_time']);
// 				$title = $result[$i]['caption']['text'];
// 				$link = $result[$i]['link'];
// 				$author=$result[$i]['user']['username'];
// 				$results[]=array('title'=>$title,'author'=>$author,'link'=>$link,'img'=>$img,'date'=>$date,'label'=>'instagram','filter'=>'social');
// 			}
// 		}
// 	curl_close($ch);
// 	return $results;
// }

function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($code == 200){
       $status = true;
    } else {
      $status = false;
    }
    curl_close($ch);
	return $status;
}


function sort_by_date($a, $b) {
    if ($a['date'] == $b['date']) return 0;
    return (strtotime($a['date']) < strtotime($b['date'])) ? 1 : -1;
}

function getFeed($feed_url) {
	$content = file_get_contents($feed_url);
	$x = new SimpleXmlElement($content);
	$results="";
	$i=1;    
	foreach($x->channel->item as $entry) {
		if($i<=20) {
			$newDate = date("d-m-Y H:i:s", strtotime($entry->pubDate));
			$results[] = array('title'=> (string) $entry->title, 'author'=> (string) $entry->author, 'link'=> (string) $entry->link,'img'=> (string) $entry->feedimg,'date'=>$newDate,'label'=>'virtual farm tour','filter'=>'virtual_farm_tour','city'=> (string) $entry->feedcity,'state'=> (string) $entry->feedstate);
			$i++;
		}
	}
	return $results;
}

function get_main_results($results) {
	$results='';
	// Get Instagram Feeds
	// $instagram_tags = array('hypenotic');
	// for($i=0;$i<count($instagram_tags);$i++) {
	// 	$instagram_url="";
	// 	$instagram_feeds="";
	// 	$client_id="84e0a91bb0ca49bc91b0b5d88eb1289c";
	// 	$instagram_url='https://api.instagram.com/v1/users/1642097123/media/recent/?scope=public_content&access_token=1642097123.7a586ed.b8c67803053443b889b46d4ae6e98f22';
	// 	$instagram_feeds=fetch_instagram_feed($instagram_url);			
	// 	if($instagram_feeds !='') {
	// 		if($results !='') {
	// 			$results=array_merge($instagram_feeds,$results);
	// 		}else {
	// 			$results=$instagram_feeds;	
	// 		}
	// 	}
	// }	

	// Get TWITTER FEEDS
	$twitter_feeds=fetch_twitter_feed();
	if($twitter_feeds !='') {
		if($results !='') {
			$results=array_merge($twitter_feeds,$results);
		}else {
			$results=$twitter_feeds;	
		}
	}

	// Facebook Feeds
	// $fb_feeds=fetch_facebook_feed();
	// if($fb_feeds !='') {
	// 	if($results !='') {
	// 		$results=array_merge($fb_feeds,$results);
	// 	}else {
	// 		$results=$fb_feeds;	
	// 	}
	// }	

	// Blog Feeds
	// $posts="";	
	query_posts("post_type=post&showposts=-1");
	if(have_posts()):while(have_posts()):the_post();
		if ( has_post_thumbnail() ) {
			$img=wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
			$image=$img[0];
		} else if (catch_that_image() !== '') {
			$image=catch_that_image();
		}
		$posts[] = array('title'=>get_the_title(),'author'=>get_the_author(),'link'=>get_permalink(),'img'=>$image,'date'=>get_the_date(), 'label'=>'blog','filter'=>'blog','post_id'=>get_the_ID());
	endwhile;endif;
	if($posts !='') {
		if($results !='') {
			$results=array_merge($posts,$results);
		}else {
			$results=$posts;	
		}
	}
	if($results) {
		usort($results, "sort_by_date");
		for( $j=0;$j<count($results);$j++) {
			$results[$j]['row_id'] = $j+1 ;
			?>
			
			<?php
		}
	}
	// print_r($results);
	// return $results;
	show_twit_results($results);
}

function get_feed_results($feeds) {
		$results='';
		for($i=0;$i<count($feeds);$i++) {
			$params = array(
			  'q' => $feeds[$i]['link'],
			  'v' => '1.0', // API version
			  'num' => 10, // maximum entries (limited)
			  'output' => 'JSON', // mixed content: JSON for feed, XML for full entries (json|xml|json_xml)
			  'scoring' => 'h', // include historical entries
			);
			$result = file_get_contents('http://ajax.googleapis.com/ajax/services/feed/load?' . http_build_query($params));
			$json = json_decode($result);
			$data = $json->responseData;
			// json version
			if($data) {
				if($data->feed->entries) {
					foreach ($data->feed->entries as $entry) {
						$title=$entry->title;
						$author=$entry->author;
						if($feeds[$i]['label']=='pinterest') {
							$title=$entry->contentSnippet;	
						}
						// Get Img src from content
						$doc = new DOMDocument();
						@$doc->loadHTML($entry->content);	
						$tags = $doc->getElementsByTagName('img');
						$img=''; 		
						foreach ($tags as $tag) {
							$img = $tag->getAttribute('src');
							if($feeds[$i]['label']=='pinterest') {	
								$img = str_replace('/192x/', '/736x/', $img);
							}
							if($feeds[$i]['label']=='facebook') {								
								if (strpos($img,'url=') == true) {
									$img = explode("url=", $img);
									$img = urldecode($img[1]);
								}
								if (strpos($img,'/v/t1.0-9/') == true) {
									$img = explode("/v/t1.0-9/", $img);
									$img=implode("/",$img);
								}
								if (strpos($img,'/v/t1.0-9/s720x720/') == true) {
									$img = explode("/v/t1.0-9/s720x720/", $img);
									$img=implode("/",$img);
								}
								if (strpos($img,'/p130x130/') == true) {
									$img = explode("/p130x130/", $img);
									$img=implode("/",$img);
								}
								if (strpos($img,'/s130x130/') == true) {
									$img = explode("/s130x130/", $img);
									$img=implode("/",$img);
								}
								if (strpos($img,'/p100x100/') == true) {
									$img = explode("/p100x100/", $img);
									$img=implode("/",$img);
								}
							}
						}
						// Push feed entries to an array
						$newDate = date("d-m-Y H:i:s", strtotime($entry->publishedDate));
						$results[] = array('title'=>$title,'author'=>$author,'link'=>$entry->link,'img'=>$img,'date'=>$newDate,'author'=>$author, 'label'=>$feeds[$i]['label'],'filter'=>$feeds[$i]['filter']);
					}
				}
			}	
		}
		// Get Instagram Feeds
		// $instagram_tags = array('hypenotic');
		// for($i=0;$i<count($instagram_tags);$i++) {
		// 	$instagram_url="";
		// 	$instagram_feeds="";
		// 	$client_id="84e0a91bb0ca49bc91b0b5d88eb1289c";
		// 	$instagram_url='https://api.instagram.com/v1/users/1642097123/media/recent/?scope=public_content&access_token=1642097123.7a586ed.b8c67803053443b889b46d4ae6e98f22';
		// 	$instagram_feeds=fetch_instagram_feed($instagram_url);			
		// 	if($instagram_feeds !='') {
		// 		if($results !='') {
		// 			$results=array_merge($instagram_feeds,$results);
		// 		}else {
		// 			$results=$instagram_feeds;	
		// 		}
		// 	}
		// }	

		// Facebook Feeds
		// $fb_feeds=fetch_facebook_feed();
		// if($fb_feeds !='') {
		// 	if($results !='') {
		// 		$results=array_merge($fb_feeds,$results);
		// 	}else {
		// 		$results=$fb_feeds;	
		// 	}
		// }	
		// Blog Feeds
		$posts="";	
		query_posts("post_type=post&showposts=-1");
		if(have_posts()):while(have_posts()):the_post();
			if ( has_post_thumbnail() ) {
				$img=wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); 
				$image=$img[0];
			} else if (catch_that_image() !== '') {
				$image=catch_that_image();
			}
			$posts[] = array('title'=>get_the_title(),'author'=>get_the_author(),'link'=>get_permalink(),'img'=>$image,'date'=>get_the_date(), 'label'=>'blog','filter'=>'blog','post_id'=>get_the_ID());
		endwhile;endif;
		if($posts !='') {
			if($results !='') {
				$results=array_merge($posts,$results);
			}else {
				$results=$posts;	
			}
		}
		if($results) {
			usort($results, "sort_by_date");
			for( $j=0;$j<count($results);$j++) {
				$results[$j]['row_id'] = $j+1 ;
				?>
				
				<?php
			}
		}
		return $results;
}

function show_twit_results( $results = NULL ) {
    if( !$results ) return false;
	$total = count($results);
		$i=0;
			foreach( $results as $result) {
				$id=$result['row_id'];
				$link= $result['link'];
				$title=$result['title'];
				$author=$result['author'];
				$feed_img=$result['img'];
				$label=$result['label'];
				$filter=$result['filter'];
				$newDate=$result['date'];			
				$default_image=get_bloginfo('template_url')."/dist/images/default_banner.jpg";				
				$output = '';
				$classes = '';
				if($label=='blog') {
					$post_id=$result['row_id'];
					if($post_id) {
						$categories = get_the_category($post_id);
						$separator = ', ';
						if($categories){
							foreach($categories as $category) {
								$classes .= $category->category_nicename.' ';
								$output .= '<small>'.$category->cat_name.'</small>'.$separator;
							}
							$output="<div class='categories'>".trim($output, $separator).'</div>';
						}
					}								
				}
				?>
				<div class="grid-item <?php if ($label == 'twitter') { echo 'grid-item--2x1'; } else { echo 'grid-item--4x2';} ?> <?php echo $label;?> <?php echo $filter;?> <?php echo $classes;?>" data-category="transition" id="<?php echo "item_".$id;?>">	
					<div class="grid-item__icon">
						<?php if ($label == 'twitter') { ?>
							<a href="<?php echo $link;?>" target="_blank"><i class="fa fa-twitter"></i></a>
						<?php } else if ($label == 'instagram') { ?>
							<a href="<?php echo $link;?>" target="_blank"><i class="fa fa-instagram"></i></a>
						<?php } else if ($label == 'facebook') { ?>
							<a href="<?php echo $link;?>" target="_blank"><i class="fa fa-facebook-official"></i></a>
						<?php } else { ?>
							<a href="<?php echo $link;?>"><i class="fa fa-pencil"></i></a>
						<?php } ?>
					</div>
					<div class="post">
							<?php 
								
								if($feed_img==''){
									$feed_img=$default_image;
									$error_img=$default_image;
								}

							?>
						<?php if ($label == 'facebook') { ?>
						 
		            	<?php }  else if ($label == 'twitter') { ?>

		            	<?php } else { ?>
		            	<a href="<?php echo $link;?>" <?php if($label!='blog') { ?> target="_blank" <?php } ?>>
			                <div class="post-image" style="background-image:url(<?php echo $feed_img;?>);">
				                <img class="post-img" src="<?php echo $feed_img;?>" style="display:none;">
			            	</div>
		            	</a>
		            	<?php } ?>	
	                    <div class="post-title">
	                    	<!-- <p><?php //echo date("M d, Y", strtotime($newDate));?></p> -->
	                    <p class="title">
	                    	<a href="<?php echo $link;?>" <?php if($label!='blog') { ?> target="_blank" <?php } ?>>
							<?php 					
								if (strlen($title) > 75 && $label !== 'twitter') {
									echo substr($title, 0, 75) . '...'; 
								
								} else {
									echo $title;
								}
							?>
	                        </a>
	                    </p>
	                    <?php if ($label == 'facebook') { ?>
							<a href="<?php echo $link;?>" target="_blank">
			                <div class="post-image" style="background-image:url(<?php echo $feed_img;?>);">
				                <img class="post-img" src="<?php echo $feed_img;?>" style="display:none;">
			            	</div>
		            		</a>
		            	<?php } ?>
						<?php echo $output;?>
						</div>
					</div>
				</div>	
				<?php
			}
}

function show_feed_results( $results = NULL ) {
    if( !$results ) return false;
	$total = count($results);
		$i=0;
			foreach( $results as $result) {
				$id=$result->row_id;
				$link= $result->link;
				$title=$result->title;
				$author=$result->author;
				$feed_img=$result->img;
				$label=$result->label;
				$filter=$result->filter;
				$newDate=$result->date;			
				$default_image=get_bloginfo('template_url')."/dist/images/default_banner.jpg";				
				$output = '';
				$classes = '';
				if($label=='blog') {
					$post_id=$result->post_id;
					if($post_id) {
						$categories = get_the_category($post_id);
						$separator = ', ';
						if($categories){
							foreach($categories as $category) {
								$classes .= $category->category_nicename.' ';
								$output .= '<small>'.$category->cat_name.'</small>'.$separator;
							}
							$output="<div class='categories'>".trim($output, $separator).'</div>';
						}
					}								
				}
				?>
				<div class="post-item item transition <?php echo $label;?> <?php echo $filter;?> <?php echo $classes;?>" data-category="transition" id="<?php echo "item_".$id;?>">	
					<div class="post">
							<?php 
								
								if($feed_img==''){
									$feed_img=$default_image;
									$error_img=$default_image;
								}

							?>
		                <div class="post-image" style="background-image:url(<?php echo $feed_img;?>);">
			                <img class="post-img" src="<?php echo $feed_img;?>" style="display:none;">
		            	</div>		
	                    <div class="post-title">
	                    	<p><?php echo date("M d, Y", strtotime($newDate));?></p>
	                    <p class="title">
	                    	<a href="<?php echo $link;?>" <?php if($label!='blog') { ?> target="_blank" <?php } ?>>
							<?php 					
								if (strlen($title) > 75) {
									echo substr($title, 0, 75) . '...'; 
								
								} else {
									echo $title;
								}
							?>
	                        </a>
	                    </p>
						<?php echo $output;?>
						</div>
					</div>
				</div>	
				<?php
			}
}

function json_cached_results($urls,$cache_file = NULL, $expires = NULL) {
    global $request_type, $purge_cache, $limit_reached, $request_limit;
	ob_start();
    if( !$cache_file ) $cache_file = TEMPLATEPATH. '/rss-feed.json';
    if( !$expires) $expires = time() - 60 * 10;
    if( !file_exists($cache_file) ) die("Cache file is missing: $cache_file");
	if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 10 )) && file_get_contents($cache_file)  != '') {
		// Cache file is less than fifteen minutes old. 
		// Don't bother refreshing, just use the file as-is.
		$json_results = file_get_contents($cache_file);
	} else {
		//$file = file_get_contents($url);
		$json_results ="";
		file_put_contents($cache_file, $json_results, LOCK_EX);
		$api_results = get_feed_results($urls);
		$json_results = json_encode($api_results);
		file_put_contents($cache_file, $json_results, LOCK_EX);
	}
    return json_decode($json_results);
	ob_end_flush();
}