<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<section class="carousel-section">
    <div class='container'>
      <div class='carousel'>
      <h2><?php echo __("Stories");?><span class="view-all"><a href="<?php echo url("exhibits/browse");?>"><?php echo __('Browse all stories');?></a></span></h2>
      <div class="owl-carousel">
        <?php $records = get_records('Exhibit',array('sort_field' => 'added', 'sort_dir' => 'd'),10);?>
        <?php foreach($records as $record):?>
          <div class="item">
            <?php $file = get_record_by_id('File',$record->cover_image_file_id);?>
            <a href="<?php echo record_url($record);?>"><img src="<?php echo $file->getWebPath("square_thumbnail");?>"/></a>
            <div class="inner">
              <a href="<?php echo record_url($record);?>"><?php echo metadata($record, 'Title');?></a>
            </div>
            <div class="tags fadeInRight">
              <?php
                $tags = get_db()->getTable('Tag')->findBy(array('record'=>$record));
                foreach ($tags as $tag) {
                  echo '<span><a href="' . html_escape(url('exhibits/browse', array('tags' => $tag->name))) . '" rel="tag">' . html_escape($tag->name) . '</a></span>';
                }
              ?>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</section>
<section class="timeline-section">
  <div class="container">
    <div class="timeline-teaser">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="teaser-text">
          <h2><?php echo __('Timeline');?></h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dolor nunc, fringilla eu orci at, dictum viverra neque.</p>
          <p>Phasellus elit velit, ullamcorper a vehicula ac, hendrerit in urna.</p>
        </div>
      </div>
      <div class="col-md-7 timeline-link">
        <a href="<?php echo url("neatline-time/timelines/show/1");?>">
          <?php echo __("Visit the timeline");?><i class="material-icons">keyboard_arrow_right</i>
        </a>
      </div>
    </div>
  </div>
  </div>
</section>
<section class="news">
  <div class="container">
      <h2><?php echo __('News');?><span class="view-all"><a href="<?php echo url('news');?>"><?php echo __('More news');?></a></span></h2>
      <div class="row">
        <!-- spotlight -->
        <div class="col-md-12">
          <div class="row">
            <?php $spotlights = get_records('Item',array("type"=>"News",'sort_field' => 'added', 'sort_dir' => 'd'),3);?>
            <?php foreach($spotlights as $record):?>
              <div class="col-12 col-sm-6 col-md-6 col-lg-4 news-home ">
                <div class="spotlight">
                  <a href="<?php echo record_url($record);?>">
                    <?php $file = $record->getFile();?>
                    <?php if($file):?>
                      <div class="img-top" style="background-image: url(<?php echo $file->getWebPath("fullsize"); ?>)"></div>
                    <?php endif;?>
                    <div class="news-item item">
                      <h3><?php echo metadata($record, array('Dublin Core', 'Title'));?></h3>
                      <p class="datum"><?php echo metadata($record, array('Dublin Core', 'Date'));?></p>
                      <p class="description">
                        <?php echo metadata($record, array('Dublin Core', 'Description'), array('snippet' => 250));?>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
  </div>
</section>


<?php echo foot(); ?>
