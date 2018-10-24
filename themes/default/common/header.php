<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')) :?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>
    <?php $lang = 'nl';?>
    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view' => $this)); ?>

    <!-- Stylesheets & javascripts -->
    <?php
    queue_js_file("lightgallery-all.min");
    queue_js_file(array("owl.carousel.min","slick.min"));
    queue_css_file(array('iconfonts', 'app.min','lightgallery.min','owl.carousel','owl.theme.default'));
    echo head_css();
    echo head_js();
    ?>
    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view' => $this)); ?>
        <header role="banner">
          <section class="nav-section">
            <div class="container">
              <nav class="navbar">
                <img class="logo" src="<?php echo img('zegel.png');?>">
                <a class="brand" href="<?php echo WEB_ROOT;?>">Charter</a>
                <div class="right">
                  <div id="lang-switcher" class="ui-dropdown-list">
                      <?php
                        $languages = array('en'=> 'EN','nl' => 'NL');
                        $path = url();
                      ?>

    			            <h2 class="visuallyhidden">Sprache wählen</h2>
                      <?php foreach ($languages as $locale => $language): ?>
                        <?php if ($locale == $lang): ?>
                            <p class="ui-dropdown-list-trigger">
                            <span class="visuallyhidden">Aktuelle Sprache: </span> <strong><?php echo $language ?></strong></p>
                        <?php endif; ?>
                      <?php endforeach; ?>
                			<ul>
                      <?php foreach ($languages as $locale => $language): ?>
                          <?php if ($locale != $lang): ?>
                               <li><a href="<?php echo str_replace($lang,$locale,$path);
                               ?>">
                                   <?php echo $language ?>
                               </a></li>
                          <?php endif;?>

                      <?php endforeach; ?>
                      </ul>
                  </div>
                  <button id="toggle">
                    <p><i class="material-icons">
                          menu
                          </i></p>
                  </button>
                </div>
              </nav>
              <nav class="navbar2">
                <?php echo public_nav_main(array('role' => 'navigation')) -> setUlClass('nav navbar-nav'); ?>
              </nav>
            </div>
          </section>
        </header>

        <section id="page-slide">
          <div class="top">
             <button class="close"><i class="material-icons">close</i></button>
          </div>
           <div class="slide-nav">

             <form class="form-inline" action="<?php echo url("solr-search");?>">
               <div class="inputs">
                 <input class="form-control" name="q" type="text" placeholder="Search the collection">
               </div>
               <div class="buttons">
                 <button class="btn" type="submit"><i class="material-icons">search</i></button>
               </div>
             </form>
             <?php echo public_nav_main(array('role' => 'navigation')) -> setUlClass('nav navbar-nav'); ?>
             <div class="tags">
               <?php $tags = get_db()->getTable('Tag')->findBy(array('type'=>'Exhibit'));?>
               <?php echo tag_cloud($tags, 'exhibits/browse'); ?>
             </div>
           </div>
         </section><!-- #page-slide -->
