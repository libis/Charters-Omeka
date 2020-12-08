<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php echo head(array(
  'title' => __('Neatline | Browse Exhibits'),
  'content_class' => 'neatline'
)); ?>

<div class="exhibit-section  simple-page-section ">
  <div class="container simple-page-container">
<div id="primary">

  <?php echo flash(); ?>
  <h2><?php echo __('Neatline | Browse Exhibits'); ?></h2>


  <?php if (nl_exhibitsHaveBeenCreated()): ?>

    <div class="pagination"><?php echo pagination_links(); ?></div>

      <?php foreach (loop('NeatlineExhibit') as $e): ?>
        <h3>
          <?php echo nl_getExhibitLink(
            $e, 'show', nl_getExhibitField('title'),
            array('class' => 'neatline'), true
          );?>
        </h3>
      <?php endforeach; ?>

    <div class="pagination"><?php echo pagination_links(); ?></div>

  <?php endif; ?>

</div>
</div>
</div>
<?php echo foot(); ?>
