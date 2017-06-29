<!--<form action="/" id="searchform" method="get">
  <input type="search" id="searchbox" name="s" placeholder="Enter keywords" required>
    <input type="image" id="searchsubmit" alt="Search" class="searchicon" src="" />
</form>
-->

<form id="searchform" method="get" action="<?php bloginfo('url'); ?>/" >
<!-- <a href="#" id="search-trigger" alt="Search" title="Search"> --><!-- <i class="fa fa-search" aria-hidden="true"></i> --><!-- <span id="search-placeholder-text">Search</span> --><!-- </a> -->
<label for="s" class="hidden-element"><?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'Rechercher'; } else { echo 'Search'; } ?></label>
<input type="text" class="searchbox" name="s" id="s" value="<?php if(ICL_LANGUAGE_CODE=='fr'){ echo 'Rechercher'; } else { echo 'Search'; } ?>" onfocus="if (this.value == 'Search' || this.value == 'Rechercher' ) {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}">
<input type="submit" id="searchsubmit" value="" />
</form>