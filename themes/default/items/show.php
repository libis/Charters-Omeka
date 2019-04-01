<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>
<?php $type = metadata('item','item_type_name');?>

<?php if ($type == 'News'): ?>
  <div class="simple-page-section ">
    <div class="container simple-page-container">
      <div class="breadcrumbs">
        <p id="simple-pages-breadcrumbs">
          <span>
            <a href="<?php echo url('/');?>"><?php echo __('Home');?></a> ›
            <a href="<?php echo url('news');?>"><?php echo __('News');?></a> ›
            <?php echo strip_tags(metadata('item', array('Dublin Core', 'Title')));?>
          </span>
        </p>
      </div>
      <!-- Content -->
      <div class="row">

          <div class="col-sm-3 col-xs-12">
            <?php
              $files = get_current_record('item')->getFiles();
              if($files):
            ?>
                <a href="<?php echo $files[0]->getWebPath('fullsize');?>">
                    <img src="<?php echo $files[0]->getWebPath('fullsize');?>" />
                </a>
            <?php endif;?>
          </div>
          <div class="col-sm-9 col-xs-12">
            <div class='content'>
              <h1 class="">
                  <?php echo strip_tags(metadata('item', array('Dublin Core', 'Title'))); ?>
              </h1>
              <p class="date"><?php echo metadata('item', array('Dublin Core', 'Date')); ?></p>
              <p class="description"><?php echo metadata('item', array('Dublin Core', 'Description')); ?></p>
            </div>
          </div>

      </div>
    </div>
  </div>
<?php else: ?>
  <section class="item-section">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12  col-lg-7 col-xl-8 image-row">
          <div id="lightgallery">
            <?php
              $files = get_current_record('item')->getFiles();
              if($files):
            ?>
                <a href="<?php echo $files[0]->getWebPath('fullsize');?>">
                    <img src="<?php echo $files[0]->getWebPath('fullsize');?>" />
                </a>
            <?php endif;?>
          </div>
        </div>

        <div class="col-md-12 col-lg-5 col-xl-4">
          <?php $texts =  all_element_texts('item',array('return_type'=>'array'));?>
            <div class='metadata'>
              <h1 class="">
                  <?php echo strip_tags(metadata('item', array('Dublin Core', 'Title'))); ?>
              </h1>

              <?php if (isset($texts['Charter Item Type Metadata']['Formal title'])): ?>
              <div class="element">
                  <h3><?php echo __('Formal title'); ?></h3>
                  <div class="element-text"><p><?php echo implode(', ',$texts['Charter Item Type Metadata']['Formal title']);?></p></div>
              </div>
              <?php endif; ?>

              <?php if (isset($texts['Charter Item Type Metadata']['Place of issue'])): ?>
              <div class="element">
                  <h3><?php echo __('Place of issue'); ?></h3>
                  <div class="element-text"><p><?php echo implode(', ',$texts['Charter Item Type Metadata']['Place of issue']);?></p></div>
              </div>
              <?php endif; ?>

              <?php if (isset($texts['Dublin Core']['Description'])): ?>
              <div class="element">
                  <h3><?php echo __('Description'); ?></h3>
                  <div class="element-text"><p><?php echo implode(', ',$texts['Dublin Core']['Description']);?></p></div>
              </div>
              <?php endif; ?>

              <?php if (isset($texts['Dublin Core']['Date'])): ?>
              <div class="element">
                  <h3><?php echo __('Date'); ?></h3>
                  <div class="element-text"><p><?php echo implode(', ',$texts['Dublin Core']['Date']); ?></p></div>
              </div>
              <?php endif; ?>

              <?php if (isset($texts['Charter Item Type Metadata']['Issuing party'])): ?>
              <div class="element">
                  <h3><?php echo __('Issuing party'); ?></h3>
                  <div class="element-text"><p><?php echo implode(', ',$texts['Charter Item Type Metadata']['Issuing party']);?></p></div>
              </div>
              <?php endif; ?>

              <?php if (isset($texts['Charter Item Type Metadata']['Reference'])): ?>
              <div class="element">
                  <h3><?php echo __('Reference'); ?></h3>
                  <div class="element-text"><p><?php echo implode(', ',$texts['Charter Item Type Metadata']['Reference']); ?></p></div>
              </div>
              <?php endif; ?>

              <!-- The following prints a list of all tags associated with the item -->
              <?php if (metadata('item', 'has tags')): ?>
              <div class="tags">
                  <h3><?php echo __('Tags'); ?></h3>
                  <div class="element-text"><?php echo solr_tag_string(); ?></div>
              </div>
              <?php endif;?>

              <br>
              <?php echo libis_link_to_related_exhibits($item);?>

              <?php if (isset($texts['Charter Item Type Metadata']['IE nummer'])): ?>
              <div class="element">
                  <img class="icon-img" src="<?php echo img('teneo_gray.png');?>"><a target="_blank" href="https://resolver.libis.be/<?php echo $texts['Charter Item Type Metadata']['IE nummer'][0]; ?>/representation"><?php echo __('Bekijk het volledige object');?></a>
              </div>
              <?php endif; ?>

              <?php
                $timeline = get_db()->getTable('NeatlineTime_Timeline')->findby(array('id' => 1));
                //$db = get_db();
                $time_items = $timeline[0]->getItems();

                foreach($time_items as $time_item):
                  if($time_item->id == get_current_record('item')->id):
                    $hashlink = 'event-'.str_replace(' ','-',trim(strtolower(strip_tags(metadata('item', array('Dublin Core', 'Title'))))));
                    $hashlink = str_replace(array('.', ','), "", $hashlink);
                    echo "<i class='material-icons'>timeline</i><a href='".url("/")."/neatline-time/timelines/show/1#".$hashlink."'>Bekijk het object op de tijdslijn</a>";
                   endif;
                endforeach;
              ?>
            </div>
        </div>

    </div>
  </div>
  </section>
<?php endif;?>

<script>
    //image control
    var divs = jQuery('div[id^="map-"]').hide(),

    N = divs.length,
    C = 0;

    if(N > 1){
      jQuery("#prev").fadeIn();
      jQuery("#next").fadeIn();
    }

    divs.hide().eq( C ).show();

    jQuery("#next, #prev").click(function(){
        jQuery("#prev").hide();
        jQuery("#next").hide();

        divs.stop().hide().fadeOut(1000).eq( (this.id=='next'? ++C : --C) %N ).fadeIn(800);
        jQuery("#prev").delay( 800 ).fadeIn();
        jQuery("#next").delay( 800 ).fadeIn();
    });

    jQuery('#lightgallery').slick({
      dots: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,
      infinite: false
    });

    jQuery("#lightgallery").lightGallery(
      {
        selector:'a'
      }
    );
</script>

<?php echo foot(); ?>
