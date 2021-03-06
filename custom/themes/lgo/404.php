<?php get_header(); ?>

<?php get_template_part( 'template-part-nav' ); ?>

<div id="skip-to-content" class="scroll-panel page-panel page__bg__fixed single-page-container--whole">
	<div class="left-compartment__bg" style="background-image: url(<?php if ($thumbnail) { ?><?php echo $thumbnail[0]; ?><?php } else { echo get_template_directory_uri().'/src/images/background_default.svg'; } ?>);">
	</div>
	<div class="dark-overlay"></div>
	<div class="right-compartment">
		
		<div class="single-page__content">
		<h2><?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'Ce contenu n\'est pas disponible.'; } else { echo 'Whoops! This content is unavailable at the moment.'; } ?></h2>
		<p><?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'Essayez une autre page ou recherche.'; } else { echo 'Please try another page, or perform a search.'; } ?></p>
		</div>
		
   	</div> <!-- END OF RIGHT COMPARTMENT -->
</div> <!-- END OF .page -->

<?php get_footer(); ?>