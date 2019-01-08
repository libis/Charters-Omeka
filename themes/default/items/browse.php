<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>
<div class="solr-section-results">
  <div class="container-fluid results-container">
    <div class="row">
        <div class="solr-results col-md-9 col-12">
            <!-- Results. -->
            <!-- Number found. -->
            <h1 id="num-found">
                <?php echo __("Search the catalogue");?>
            </h1>

            <?php echo pagination_links(); ?>
            <div class="card-columns">
              <?php foreach (loop('items') as $item) : ?>
                <!-- Document. -->
                <div class="card result">
                  <?php if (metadata($item, 'has files')): ?>
                      <div class="card-image">
                        <?php echo link_to_item(
                            item_image('thumbnail',array(), 0, $item),
                            array(),
                            'show',
                            $item
                        );?>
                      </div>
                  <?php endif;?>
                  <div class="card-body">
                    <!-- Title. -->
                    <h3>
                      <?php
                         echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink'));
                        ?>
                    </h3>

                    <?php if($creator = metadata($item, array('Dublin Core','Creator'))):?>
                        <div class="text">
                          <?php echo $creator;?>
                          <?php if($text = metadata($item, array('Dublin Core','Date'))):?>
                            <?php echo ", ".$text;?>
                          <?php endif;?>
                        </div>
                    <?php else:?>
                        <?php if($text = metadata($item, array('Dublin Core','Date'))):?>
                          <div class="text">
                            <?php echo $text;?>
                          </div>
                        <?php endif;?>
                    <?php endif;?>
                    </div>
                </div>
              <?php endforeach; ?>
            </div>
            <?php echo pagination_links(); ?>
        </div>
      </div>
    </div>
</div>
<!--
<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php endif; ?>
-->
<?php echo pagination_links(); ?>

<?php echo foot(); ?>

<!--
<div class="simple-page-section ">
  <div class="container simple-page-container">
    <div class="breadcrumbs">
      <p id="simple-pages-breadcrumbs">
        <span>
          <a href="<?php echo url('/');?>"><?php echo __('Home');?></a> ›
          <?php echo __('News');?>
        </span>
      </p>
    </div>
    <?php foreach (loop('items') as $item): ?>
    
      <div class="row">
        <div class="col-sm-2 col-xs-12">
          <?php
            $files = get_current_record('item')->getFiles();
            if($files):
          ?><img src="<?php echo $files[0]->getWebPath('fullsize');?>" />

          <?php endif;?>
        </div>
        <div class="col-sm-8 col-xs-12">
          <div class='content'>
            <h3 class="">
              <?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?>
            </h3>
            <p class="date"><?php echo metadata('item', array('Dublin Core', 'Date')); ?></p>
            <p class="description"><?php echo metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250)); ?></p>
          </div>
        </div>
      </div>
    <?php endforeach;?>
  </div>
</div>

-->
