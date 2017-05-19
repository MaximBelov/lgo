<?php 
/**
* Template Name: Home
*/
get_header(); 

$heading   = rwmb_meta( 'rw_banner_heading' );
$subhead   = rwmb_meta( 'rw_banner_subheading' );

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'banner' ); 
?>

<?php get_template_part( 'template-part-nav-transition' ); ?>

<div id="skip-to-content" class="top-page-panel home-template" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } ?>);">
	<div class="grad-overlay"></div>
	<div class="container">
		<div>
			<?php get_template_part( 'template-part-logo' ); ?>
			<h1><?php echo $heading;?></h1>
			<div class="separator"></div>
			<h2 class="home-subhead">
				<?php echo $subhead;?>
			</h2>
			<a href="#top-of-content"><svg width="16px" height="29px" viewBox="0 0 16 29" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <desc>Scroll Down</desc>
				    <defs></defs>
				    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g id="home" transform="translate(-537.000000, -609.000000)" fill="#ffffff">
				            <path d="M559.160469,623.320737 C559.160469,623.141936 559.008113,622.905075 558.855758,622.791011 L550.190998,616.240085 C549.788087,615.94311 549.130287,615.908686 548.659502,616.209771 C548.239261,616.481057 548.227708,617.006672 548.6169,617.299537 L555.572536,622.55004 L532.083095,622.55004 C531.485227,622.55004 531,622.895312 531,623.320737 C531,623.746162 531.485227,624.091434 532.083095,624.091434 L555.572536,624.091434 L548.6169,629.341937 C548.227708,629.634802 548.255869,630.1486 548.659502,630.431703 C549.085519,630.730734 549.793142,630.70453 550.190998,630.401389 L558.855758,623.850463 C559.109924,623.672175 559.15758,623.501594 559.160469,623.320737 Z" id="Page-1" transform="translate(545.080234, 623.321429) scale(-1, 1) rotate(90.000000) translate(-545.080234, -623.321429) "></path>
				        </g>
				    </g>
				</svg></a>
		</div>
	</div>
</div>

<div id="top-of-content" class="full-width-panel">
	<div> <!-- Start of RP -->
		<div class="full-width-inner-wrapper"> <!-- Start of RP inner -->
			<h2>Ontario's Storyteller in chief</h2>
			
			<div class="masonry-grid">
				<div class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<div class="grid-item--4x2--content">
							<h3>Use this tile style for featured static content</h3>
						</div>
					</div>
				</div>
				<div class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<p class="grid-item--4x2--label"><span>About</span></p>
						<div class="grid-item--4x2--content">
							<h3>Areas of Focus</h3>
							<p>Blurb about Her Honour’s special focus. 5-8 words. (this is a hover preview)</p>
						</div>
					</div>
				</div>
				<div class="grid-item grid-item--2x1 wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--2x1--label">Use this tile style for blog posts with no picture.</h3>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 grid-item grid-item--accent wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--1x1--label">Use this tile syle for CTAs like Book a tour.</h3>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 grid-item--llgrey wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--1x1--label">Find us on Facebook</h3>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 wow fadeInUp">
					<div class="grid-item__wrapper">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</div>
				</div>
				<div class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<div class="grid-item--4x2--content">
							<h3>Use this tile style for LG exhibitions</h3>
						</div>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 wow fadeInUp">
					<div class="grid-item__wrapper">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</div>
				</div>
				<div class="grid-item grid-item--4x2 wow fadeInUp">
					<div class="grid-item__wrapper">
						<p class="grid-item--4x2--label">Current Exhibit</p>
						<div class="grid-item--4x2--content">
							<h3>Canada 150</h3>
							<p>Each story recalls an experience that has left an impression—one of happiness or tragedy, of humour, or of insight. Collectively these myriad diverse stories give us meaning, through which our personal, family, and community identities are formed.</p>
						</div>
					</div>
				</div>
				<div class="grid-item grid-item--2x1 wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--2x1--label">Long news/ event/ article/ headline goes here, posted from the blog</h3>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 grid-item--llgrey wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--1x1--label">Find us on Twitter</h3>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 grid-item--accent wow fadeInUp">
					<div class="grid-item__wrapper"><h3 class="grid-item--1x1--label">Invite The LG</h3> </div>
				</div>
				<div class="grid-item grid-item--2x1 wow fadeInUp">
					<div class="grid-item__wrapper">
						<h3 class="grid-item--2x1--label">Long news/ event/ article/ headline goes here, posted from the blog</h3>
					</div>
				</div>
				<div class="grid-item grid-item--1x1 grid-item--accent wow fadeInUp">
					<div class="grid-item__wrapper"><h3 class="grid-item--1x1--label">Nonimate someone for an award</h3> </div>
				</div>
				<div class="grid-item grid-item--2x2 wow fadeInUp">
					<div class="grid-item--overlay"></div>
					<div class="grid-item__wrapper">
						<h3 class="grid-item--2x2--label">Use this tile style for blog posts with a picture.</h3>
					</div>

				</div>
			</div>


		</div> <!-- End of RP inner -->
	</div> <!-- END OF RIGHT PANEL -->
</div> <!-- END OF .page -->
<?php get_footer(); ?>