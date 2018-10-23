<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>
<?php $type = metadata('item','item_type_name');?>
<?php $metadata = all_element_texts('item',array("return_type"=>"array"));?>
<section class="item-section">
  <section class="image-section">
    <div class='container'>
        <?php if (metadata('item', 'has files') && $type != 'News'): ?>
            <div class="image-col">
              <div id="itemfiles">
                  <div class="element-text"><?php echo item_image_gallery(array('linkWrapper' => array('wrapper' => null,'class' => 'image  lightgallery')),'fullsize'); ?></div>
              </div>
            </div>
        <?php endif;?>

        <?php if (metadata('item', 'has files') && $type == 'News'): ?>
            <div id="itemfiles">
                <div class="element-text"><?php echo item_image_gallery(array('linkWrapper' => array('wrapper' => null,'class' => 'col-sm-2 col-xs-12 image')),'thumbnail'); ?></div>
            </div>
        <?php endif; ?>
    </div>
    <a class="btn-metadata" href="#metadata">i</a>
  </section>

  <?php if ($type != 'News'):?>
    <section class="metadata-title-section">
      <div class='container'>
        <h2><span><?php echo $type;?></span></h2>
        <h1 class="section-title projecten-title"><span><?php echo metadata('item', array('Dublin Core', 'Title')); ?></span></h1>
        <?php if(isset($metadata['Dublin Core']["Description"])):?>
          <div class="description"><?php echo implode(", ",$metadata['Dublin Core']["Description"]);?></div>
        <?php endif;?>
      </div>
    </section>
  <?php endif;?>
  <section id="metadata" class="metadata-section">
    <div class='container'>
      <div class="metadata-bg">
            <?php echo all_element_texts('item', array('return_type'=>'html','show_element_sets' => array('Dublin Core'))); ?>
        
      </div>
      <br>
      <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
    </div>
  </section>
<?php echo foot(); ?>
