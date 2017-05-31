<!--<form action="/" id="searchform" method="get">
  <input type="search" id="searchbox" name="s" placeholder="Enter keywords" required>
    <input type="image" id="searchsubmit" alt="Search" class="searchicon" src="" />
</form>
-->

<form id="searchform" method="get" action="<?php bloginfo('url'); ?>/" >
<input type="text" class="searchbox" name="s" id="s" value="Search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}">
<input type="submit" id="searchsubmit" style="display: none;" />
</form>