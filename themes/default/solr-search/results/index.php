<?php
/**
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */
?>

<?php queue_css_file('results'); ?>
<?php echo head(array('title' => __('Solr Search'))); ?>

<div class="solr-section-search">
  <div class="container">
    <div class="search">
      <div  class="row">
        <!-- Search form. -->
        <div class="col-12">
          <div class="solr-top">
            <h1><?php echo __("Search the catalogue");?></h1>

            <form id="solr-search-form">
              <div class="inputs">
                <input type="text" title="<?php echo __('Search keywords') ?>" name="q" placeholder="<?php echo __('Search the Collection'); ?>" value="<?php
                  echo array_key_exists('q', $_GET) ? $_GET['q'] : '';
                  ?>"
                />
              </div>
              <div class="buttons">
                <button type="submit" /><i class="material-icons">&#xE8B6;</i></button>
              </div>
            </form>
          </div>
        <!--<div class="lecture-info col-xs-12 col-md-5">
            <?php echo libis_get_simple_page_content("lecture-info");?>
        </div>-->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="solr-section-results">
  <div class="container-fluid results-container">
    <div class="row">
        <div class="solr-results col-md-9 col-12">
            <!-- Results. -->
            <!-- Number found. -->
            <h1 id="num-found">
                <?php echo __("Search the catalogue");?> (<?php echo $results->response->numFound; ?>)
            </h1>
            <div class="solr-section-applied">
                <!-- Applied facets. -->
                <div id="solr-applied-facets">
                  <ul>
                    <!-- Get the applied facets. -->
                    <?php foreach (SolrSearch_Helpers_Facet::parseFacets() as $f) : ?>
                      <li>
                        <div class="applied-name">
                          <!-- Facet label. -->
                          <?php $label = SolrSearch_Helpers_Facet::keyToLabel($f[0]); ?>
                          <span class="applied-facet-label"><?php echo $label; ?></span> >
                          <span class="applied-facet-value"><?php echo $f[1]; ?></span>
                        </div>
                        <!-- Remove link. -->
                        <div class="applied-button">
                          <?php $url = SolrSearch_Helpers_Facet::removeFacet($f[0], $f[1]); ?>
                          <a href="<?php echo $url; ?>"><i class="material-icons">&#xE14C;</i></a>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
            </div>
            <?php echo pagination_links(); ?>
            <div class="card-columns">
              <?php foreach ($results->response->docs as $doc) : ?>
                <!-- Document. -->
                <div class="card result">
                  <?php if ($doc->resulttype == 'Item') :?>
                      <?php $item = get_db()->getTable($doc->model)->find($doc->modelid);?>
                      <?php if (metadata($item, 'has files')): ?>
                          <div class="card-image">
                            <?php echo link_to_item(
                                item_image('thumbnail', array('alt' => $doc->title), 0, $item),
                                array(),
                                'show',
                                $item
                            );?>
                          </div>
                      <?php endif;?>
                  <?php endif;?>

                  <!-- Header. -->
                  <!-- Record URL. -->
                  <?php $url = SolrSearch_Helpers_View::getDocumentUrl($doc); ?>

                    <div class="card-body">
                      <!-- Title. -->
                      <h3>
                        <a href="<?php echo $url; ?>" class="result-title">
                        <?php
                          $title = is_array($doc->title) ? $doc->title[0] : $doc->title;
                          if (empty($title)) {
                              $title = '<i>'.__('Untitled').'</i>';
                          }
                          echo snippet($title,0,70);
                          ?>
                        </a>
                      </h3>

                      <?php if ($doc->resulttype == 'Item') :?>
                        <?php $item = get_db()->getTable($doc->model)->find($doc->modelid);?>
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
        <div class="col-md-3 col-12">
          <div class="solr-facets">
            <form class="form-inline" action="<?php echo url("solr-search");?>">
              <div class="inputs">
                <input class="form-control" name="q" type="text" placeholder="Search the collection">
              </div>
              <div class="buttons">
                <button class="btn" type="submit"><i class="material-icons">search</i></button>
              </div>
            </form>
            <h2><?php echo __('Limit your search'); ?></h2>
              <div id="facets">
                <?php $i = 0;?>
                <?php foreach ($results->facet_counts->facet_fields as $name => $facets) : ?>
                  <!-- Does the facet have any hits? -->
                  <?php if (count(get_object_vars($facets))) : ?>
                    <!-- Facet label. -->
                    <?php $label = SolrSearch_Helpers_Facet::keyToLabel($name); ?>
                    <h3><?php echo $label; ?></h3>
                    <div class="values">
                      <ul>
                      <!-- Facets. -->
                        <?php foreach ($facets as $value => $count) : ?>
                          <li class="<?php echo $value; ?>">
                            <!-- Facet URL. -->
                            <?php $url = SolrSearch_Helpers_Facet::addFacet($name, $value); ?>
                            <!-- Facet link. -->
                            <a href="<?php echo $url; ?>" class="facet-value">
                                <?php echo $value; ?>
                            </a>
                            <!-- Facet count. -->
                            (<span class="facet-count"><?php echo $count; ?></span>)
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script>
jQuery( function() {
  jQuery( "#facets" ).accordion({
    collapsible: true,
    icons: true,
    heightStyle: "content",
    animate: false
  });
} );
</script>
<?php echo foot();
