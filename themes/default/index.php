<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<section class="hero-section">
  <div class="jumbotron">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <!--<div class="intro">
              <?php echo libis_get_simple_page_content("homepage-info");?>
            </div>-->
            <div class="logos">
              <a href="http://kuleuven.be"><img src="<?php echo img("KULEUVEN.png");?>"></a>
              <a href=""><img src="<?php echo img("Logo_baillet.png");?>"></a>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
<section class="carousel-section">
    <div class='container'>
      <div class='carousel'>
      <h2><?php echo __("Stories");?><span class="view-all"><a href="<?php echo url("exhibits/browse");?>"><?php echo __('Browse all stories');?></span></a></h2>
      <div class="owl-carousel">
        <?php $records = get_records('Exhibit',array('sort_field' => 'added', 'sort_dir' => 'd'),10);?>
        <?php foreach($records as $record):?>
          <div class="item">
            <?php $file = get_record_by_id('File',$record->cover_image_file_id);?>
            <img src="<?php echo $file->getWebPath("square_thumbnail");?>"/>
            <div class="inner">
              <a href="<?php echo record_url($record);?>"><?php echo metadata($record, 'Title');?></a>
            </div>
            <div class="tags fadeInRight">
              <?php
                $tags = get_db()->getTable('Tag')->findBy(array('record'=>$record));
                foreach ($tags as $tag) {
                  echo '<span><a href="' . html_escape(url('exhibit/browse', array('tags' => $tag->name))) . '" rel="tag">' . html_escape($tag->name) . '</a></span>';
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
                        <?php echo metadata($record, array('Dublin Core', 'Description'), array('snippet' => 150));?>
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
<script>
jQuery(document).ready(function(){
  jQuery(".owl-carousel").owlCarousel(
    {
        center:true,
        loop:true,
        margin:30,
        nav:true,
        autoWidth:true,
        items:3,
        navText : ['<i class="material-icons">navigate_before</i>','<i class="material-icons">navigate_next</i>'],
        responsive:{
        0:{
            items:1,
            stagePadding: 60
        },
        600:{
            items:1,
            stagePadding: 100
        },
        1000:{
            items:1,
            stagePadding: 200
        },
        1200:{
            items:3,
            stagePadding: 250
        },
        1400:{
            items:3,
            stagePadding: 300
        },
        1600:{
            items:3,
            stagePadding: 350
        },
        1800:{
            items:3,
            stagePadding: 400
        }
      }
    }
  );
});
</script>

<?php echo foot(); ?>
