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

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view' => $this)); ?>

    <!-- Stylesheets & javascripts -->
    <?php
    queue_js_file("lightgallery-all.min");
    queue_js_file("owl.carousel.min");
    queue_css_file(array('iconfonts', 'app.min','lightgallery.min','owl.carousel','owl.theme.default'));
    echo head_css();
    echo head_js();
    ?>
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i,700&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view' => $this)); ?>
        <header role="banner">
          <section class="nav-section">
          <div class="container nav-container">
            <nav class="navbar">
              <button class="toggle" type="button">
                &#9776;
              </button>
              <img class="logo" src="<?php echo img('logo.png');?>">
              <a class="brand" href="<?php echo WEB_ROOT;?>">Charter</a>

              <div class="left">
                <form class="form-inline" action="<?php echo url("solr-search");?>">
                  <div class="inputs">
                    <input class="form-control" name="q" type="text" placeholder="Search the collection">
                  </div>
                  <div class="buttons">
                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                  </div>
                </form>
              </div>
              <div class="right">
                <?php echo public_nav_main(array('role' => 'navigation')) -> setUlClass('nav navbar-nav'); ?>
              </div>
            </nav>

          </div>
          </section>
        </header>

        <?php //echo search_form();?>
