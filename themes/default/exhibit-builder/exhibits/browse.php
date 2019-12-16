<?php
$title = __('Browse stories');
echo head(array('title' => $title, 'bodyclass' => 'stories browse'));
?>
<section class="exhibit-section simple-page-section">
    <div class="container simple-page-container">
        <!--<div class='breadcrumbs'>
            <p id="simple-pages-breadcrumbs">
              <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
               > <span><?php echo __("Stories");?></span>
            </p>
        </div>-->
        <h2><?php echo $title; ?></h2>
        <?php if(sizeof($exhibits > 0)): ?>

        <div class="row">
          <div class="col-12 col-md-9">
            <div class="row">

                <?php foreach ($exhibits as $exhibit): ?>
                  <div class="col-md-4">
                    <div class="tile">
                      <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
                          <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
                      <?php endif; ?>
                      <div class="text">
                          <h3><?php echo exhibit_builder_link_to_exhibit($exhibit,metadata($exhibit, 'title')); ?></h3>
                          <?php if ($exhibitCredits = metadata($exhibit, 'credits')): ?>
                          <div class="credits"><?php echo $exhibitCredits; ?></div>
                          <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
            </div>
                <?php echo pagination_links(); ?>
          </div>
          <div class="col-md-3">
              <div class="tags">
                <?php $tags = get_db()->getTable('Tag')->findBy(array('type'=>'Exhibit'));?>
                <?php echo tag_cloud($tags, 'exhibits/browse'); ?>
              </div>
            </div>
          </div>
          <?php else: ?>
            <p><?php echo __('There are no exhibits available yet.'); ?></p>
          <?php endif; ?>
      </div>
</section>
<?php echo foot(); ?>
