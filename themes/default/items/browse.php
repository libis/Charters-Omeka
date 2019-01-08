<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>
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
      <!-- Content -->
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
