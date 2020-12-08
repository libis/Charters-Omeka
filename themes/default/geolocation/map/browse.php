<?php
queue_css_file('geolocation-items-map');

$title = __('Browse Items on the Map') . ' ' . __('(%s total)', $totalItems);
echo head(array('title' => $title, 'bodyclass' => 'map browse'));
?>
<div class="exhibit-section  simple-page-section ">
  <div class="container simple-page-container">
<h2><?php echo $title; ?></h2>

<!--<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php
echo item_search_filters();
echo pagination_links();
?>-->

<div id="geolocation-browse">
    <?php echo $this->geolocationMapBrowse('map_browse', array('list' => 'map-links', 'params' => $params)); ?>
    <!--<div id="map-links"><h2><?php echo __('Find An Item on the Map'); ?></h2></div>-->
</div>
</div>
</div>

<?php echo foot(); ?>
