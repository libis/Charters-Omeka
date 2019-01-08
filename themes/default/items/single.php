<div class="item record shortcode">
  <div class="row">
    <div class="col-sm-2 col-xs-12">
      <?php if (metadata($item, 'has files')) {
          echo link_to_item(
              item_image(null, array(), 0, $item),
              array('class' => 'image'), 'show', $item
          );
      }
      ?>
    </div>
    <div class="col-sm-8 col-xs-12">
      <?php
      $title = metadata($item, 'display_title');
      $description = metadata($item, array('Dublin Core', 'Description'), array('snippet' => 200));
      $date = metadata($item, array('Dublin Core', 'Date'));
      ?>
      <h2><?php echo link_to($item, 'show', $title); ?></h2>

      <?php if ($date): ?>
          <p class="item-date"><?php echo $date; ?></p>
      <?php endif; ?>
      <?php if ($description): ?>
          <p class="item-description"><?php echo $description; ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
