<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-lg-1 col-lg-5">
              <div class="intro">
                <?php echo libis_get_simple_page_content("homepage-info");?>

                <p class="more"><a href="<?php echo url("about");?>">Learn more</a><a href="<?php echo url("/solr-search");?>">Visit the collection</a></p>
              </div>
            </div>
        </div>
    </div>
</div>
<section class="carousel-section">
    <div class='container'>
      <h2>Collection Leuven <a href="<?php echo url("solr-search?q=&facet=collection:&quot;Leuven&quot;");?>">view all</a></h2>
    </div>
    <div class='container'>
      <div class="owl-carousel">
        <?php $records = get_records('Item',array("collection"=>"2",'sort_field' => 'added', 'sort_dir' => 'd'),10);?>
        <?php foreach($records as $record):?>
          <?php $file = $record->getFile();?>
          <div class="item">
            <img src="<?php echo $file->getWebPath("thumbnail");?>"/>
            <div class="inner">
              <a href="<?php echo record_url($record);?>"><?php echo metadata($record, array('Dublin Core', 'Title'));?></a>
            </div>
            </a>
          </div>
        <?php endforeach;?>
    </div>
  </div>
</section>

<section class="news">
  <div class="container">
      <h2>Spotlight & news</h2>
      <div class="row">
        <!-- spotlight -->
        <div class="col-md-3 news-home ">
          <div class="spotlight">
              <?php $spotlights = get_records('Item',array("featured"=>"1",'sort_field' => 'added', 'sort_dir' => 'd'),3);?>

              <?php foreach($spotlights as $record):?>
                <a href="<?php echo record_url($record);?>">
                  <?php $file = $record->getFile();?>
                  <div class="img-top" style="background-image: url(<?php echo $file->getWebPath("fullsize"); ?>)"></div>
                  <div class="news-item item">
                    <h3><?php echo metadata($record, array('Dublin Core', 'Title'));?></h3>
                    <p class="description">
                      <?php echo metadata($record, array('Dublin Core', 'Description'), array('snippet' => 200));?>
                    </p>
                  </div>
                </a>
              <?php endforeach;?>
            </div>
        </div>

        <div class="col-md-3 news-home ">
          <div class="spotlight">
              <?php $spotlights = get_records('Item',array("featured"=>"1",'sort_field' => 'added', 'sort_dir' => 'd'),3);?>

              <?php foreach($spotlights as $record):?>
                <a href="<?php echo record_url($record);?>">
                  <?php $file = $record->getFile();?>
                  <div class="img-top" style="background-image: url(<?php echo $file->getWebPath("fullsize"); ?>)"></div>
                  <div class="news-item item">
                    <h3><?php echo metadata($record, array('Dublin Core', 'Title'));?></h3>
                    <p class="description">
                      <?php echo metadata($record, array('Dublin Core', 'Description'), array('snippet' => 200));?>
                    </p>
                  </div>
                </a>
              <?php endforeach;?>
            </div>
        </div>

        <div class="col-md-3 news-home ">
          <div class="spotlight">
              <?php $spotlights = get_records('Item',array("featured"=>"1",'sort_field' => 'added', 'sort_dir' => 'd'),3);?>

              <?php foreach($spotlights as $record):?>
                <a href="<?php echo record_url($record);?>">
                  <?php $file = $record->getFile();?>
                  <div class="img-top" style="background-image: url(<?php echo $file->getWebPath("fullsize"); ?>)"></div>
                  <div class="news-item item">
                    <h3><?php echo metadata($record, array('Dublin Core', 'Title'));?></h3>
                    <p class="description">
                      <?php echo metadata($record, array('Dublin Core', 'Description'), array('snippet' => 200));?>
                    </p>
                  </div>
                </a>
              <?php endforeach;?>

              <div class="more-news">
                    <a href="<?php echo url("solr-search");?>">Explore collections</a>
              </div>
            </div>
        </div>



        <div class="col-md-3">
          <div class="spotlight">
            <?php $news = get_records('Item',array("type"=>"News",'sort_field' => 'added', 'sort_dir' => 'd'),3);?>
            <?php foreach($news as $record):?>
              <a href="<?php echo record_url($record);?>"><div class="news-item">
                    <h3><?php echo metadata($record, array('Dublin Core', 'Title'));?></h3>
                    <p class="datum"><?php echo metadata($record, array('Dublin Core', 'Date'));?></p>
                    <p class="description">
                      <?php echo metadata($record, array('Dublin Core', 'Description'), array('snippet' => 150));?>
                    </p>
              </div></a>
            <?php endforeach;?>

            <div class="more-news">
                  <a href="<?php echo url('news');?>">More news</a>
            </div>
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
