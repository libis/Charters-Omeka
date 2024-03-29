<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php echo head(array(
  'title' => nl_getExhibitField('title'),
  'bodyclass' => 'neatline show'
)); ?>
<div class="exhibit-section simple-page-section ">
  <div class="container simple-page-container">
<!-- Exhibit title: -->
<h2><?php echo nl_getExhibitField('title'); ?></h2>

<!-- Link to accessible alternative representation -->
<?php echo nl_getExhibitAccessibleURL(null, __('Accessible Alternative')); ?>

<!-- "View Fullscreen" link: -->
<?php echo nl_getExhibitLink(
  null, 'fullscreen', __('View Fullscreen'), array('class' => 'nl-fullscreen')
); ?>

<!-- Exhibit and description : -->
<?php echo nl_getExhibitMarkup(); ?>
<hr /><?php echo nl_getNarrativeMarkup(); ?>
</div>
</div>
<?php echo foot(); ?>
