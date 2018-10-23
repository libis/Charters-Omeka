<?php
$title = metadata('exhibit', 'title');
echo head(array(
    'title' => metadata('exhibit_page', 'title').' &middot; '.$title,
    'bodyclass' => 'exhibits', ));
?>

<section class="exhibit-section exhibit-show-section">
  <?php
    $file = get_record_by_id('File',$exhibit->cover_image_file_id);
  ?>
  <style>
  .jumbotron {
      background: #F4F5F8 url("<?php echo $file->getWebPath("thumbnail");?>") no-repeat;
      background-size: cover;
      background-position: center;
  }
  </style>
  <!--<div class="jumbotron">
    <div class="container">
      <div class="row">
            <div class="col-sm-12 offset-md-1 col-md-8 offset-lg-1 col-lg-6">
              <div class="intro">

              </div>
            </div>
        </div>
    </div>
  </div>-->
  <div class='container'>
    <!--<div class='breadcrumbs'>
        <p id="simple-pages-breadcrumbs"><span><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></strong> &#8250; <?php echo exhibit_builder_page_trail();?></p>
    </div>-->
    <h2 class="exhibit-page"><span ><?php echo metadata('exhibit_page', 'title'); ?></span></h2>
    <div class="row">
      <div class="col-12 col-md-10">
        <!--  <h2><span><?php echo metadata('exhibit', 'title'); ?></span></h2>-->


        <div id="exhibit-blocks">
          <?php exhibit_builder_render_exhibit_page(); ?>
        </div>

        <!--<?php if ($prevLink = exhibit_builder_link_to_previous_page('<i class="material-icons">&#xE314;</i>')): ?>
        <div id="abs-exhibit-nav-prev">
        <?php echo $prevLink; ?>
        </div>
        <?php endif; ?>
        <?php if ($nextLink = exhibit_builder_link_to_next_page('<i class="material-icons">&#xE315;</i>')): ?>
        <div id="abs-exhibit-nav-next">
        <?php echo $nextLink; ?>
        </div>
        <?php endif; ?>-->

        <div id="exhibit-page-navigation">
            <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
            <div id="exhibit-nav-prev">
            <?php echo $prevLink; ?>
            </div>
            <?php endif; ?>
            <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
            <div id="exhibit-nav-next">
            <?php echo $nextLink; ?>
            </div>
            <?php endif; ?>
        </div>
      </div>
      <div class='col-md-2 col-12 nav'>
        <div class="tags">
          <?php
          $tags = get_db()->getTable('Tag')->findBy(array('record'=>$exhibit));
          foreach ($tags as $tag) {
              echo '<a href="' . html_escape(url('exhibits/browse', array('tags' => $tag->name))) . '" rel="tag">' . html_escape($tag->name) . '</a>';
              }
          ?>
        </div>
        <!--    <h4><?php echo __("Table of contents");?></h4>
            <?php
            $pageTree = exhibit_builder_page_tree();
            if ($pageTree):
            ?>
            <nav id="exhibit-pages">
                <?php echo $pageTree; ?>
            </nav>
          <?php endif; ?>
        <div class="plugins">
          <?php
            $url = absolute_url();
            $title = strip_formatting(metadata($exhibit, 'title'));
            $description = strip_formatting(metadata($exhibit, 'description', array('no_escape' => true)));
          ?>
        </div>-->
      </div>
  </div>
  </div>
</section>
<?php echo foot(); ?>
