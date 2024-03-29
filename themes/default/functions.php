<?php
add_translation_source(dirname(__FILE__) . '/languages');
function public_nav_main_bootstrap() {
    $partial = array('common/menu-partial.phtml', 'default');
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function simple_nav(){
    $page = get_current_record('SimplePagesPage');

    $links = simple_pages_get_links_for_children_pages();
    if(!$links):
        $links = simple_pages_get_links_for_children_pages($page->parent_id);
    endif;

    $links_filtered = array();

    foreach($links as $link):
      if (!strpos($link['label'], '-info')) {
        $links_filtered[] = $link;
      }
    endforeach;

    $links = $links_filtered;

    $html="<ul class='simple-nav'>";
    foreach($links as $link):
        $html .= "<li><a href='".$link['uri']."'>".$link['label']."</a></li>";
    endforeach;
    $html .="</ul>";

    return $html;
}

function libis_get_simple_page_content($title) {
    $page = get_record('SimplePagesPage', array('title' => $title));
    if($page):
        return $page->text;
    else:
        return false;
    endif;
}

function get_related($relations){
    $element = get_db()->getTable('Element')->findByElementSetNameAndElementName('Dublin Core', 'Identifier');
    $id = $element->id;
    $items = array();
    foreach($relations as $relation):
      $result = get_records(
        'Item',
        array(
            'advanced' => array(
                array(
                    'element_id' => $id,
                    'type' => 'is exactly',
                    'terms' => $relation,
                )
            )
        )
      );
      foreach($result as $item):
          $items[]=$item;
      endforeach;
    endforeach;

    if(sizeof($items)> 0):
      return related_html($items);
    else:
      return false;
    endif;
}

function get_hierarchy($relations){
    $element = get_db()->getTable('Element')->findByElementSetNameAndElementName('Dublin Core', 'Identifier');
    $id = $element->id;
    $items = array();
    foreach($relations as $relation):
      $result = get_records(
        'Item',
        array(
            'advanced' => array(
                array(
                    'element_id' => $id,
                    'type' => 'is exactly',
                    'terms' => $relation,
                )
            )
        )
      );
      foreach($result as $item):
          $items[]=$item;
      endforeach;
    endforeach;

    if(sizeof($items)> 0):
      $html = "";
      $relation_array = array();

      foreach($items as $item):
        $relation_array["links"][] = link_to_item(metadata($item, array("Dublin Core","Title")),array(),"show",$item);
      endforeach;

      return $relation_array;
    else:
      return false;
    endif;
}



function related_html($items){
  $html = "";
  $relation_array = array();

  foreach($items as $item):
    $relation_array[metadata($item,'item_type_name')]["links"][] = link_to_item(metadata($item, array("Dublin Core","Title")),array(),"show",$item);
    $relation_array[metadata($item,'item_type_name')]["records"][] = $item;
  endforeach;

  return $relation_array;
}

function libis_link_to_related_exhibits($item) {

    $db = get_db();

    $select = "
    SELECT e.* FROM {$db->prefix}exhibits AS e
    INNER JOIN {$db->prefix}exhibit_pages AS ep on ep.exhibit_id = e.id
    INNER JOIN {$db->prefix}exhibit_page_blocks AS epb ON epb.page_id = ep.id
    INNER JOIN {$db->prefix}exhibit_block_attachments AS epba ON epba.block_id = epb.id
    WHERE epba.item_id = ? group by e.id";

    $exhibits = $db->getTable("Exhibit")->fetchObjects($select,array($item->id));

    if(!empty($exhibits)) {
        foreach($exhibits as $exhibit) {
            $tags = tag_string($exhibit,null);
            $tags = explode(",",$tags);
            $type = "";

            if(in_array("tentoonstelling",$tags)):
              $type = "tentoonstelling";
            elseif(in_array("project",$tags)):
              $type = "project";
            else:
              $type = "bijzonder werk";
            endif;
            echo '<div class="element in-exhibit"><i class="material-icons">&#xE3B6;</i><a href="'.exhibit_builder_exhibit_uri($exhibit).'">'.__("Related story: ").'<strong>'.$exhibit->title.'</strong></a></div>';
        }
    }
}

function libis_link_to_related_exhibits_string($item) {

    $db = get_db();
    $html = "";

    $select = "
    SELECT e.* FROM {$db->prefix}exhibits AS e
    INNER JOIN {$db->prefix}exhibit_pages AS ep on ep.exhibit_id = e.id
    INNER JOIN {$db->prefix}exhibit_page_blocks AS epb ON epb.page_id = ep.id
    INNER JOIN {$db->prefix}exhibit_block_attachments AS epba ON epba.block_id = epb.id
    WHERE epba.item_id = ? group by e.id";

    $exhibits = $db->getTable("Exhibit")->fetchObjects($select,array($item->id));

    if(!empty($exhibits)) {
        foreach($exhibits as $exhibit) {
            $tags = tag_string($exhibit,null);
            $tags = explode(",",$tags);
            $type = "";

            if(in_array("tentoonstelling",$tags)):
              $type = "tentoonstelling";
            elseif(in_array("project",$tags)):
              $type = "project";
            else:
              $type = "bijzonder werk";
            endif;
            $html .= '<div class="element in-exhibit"><i class="material-icons">&#xE3B6;</i><a href="'.exhibit_builder_exhibit_uri($exhibit).'">'.__("Related story: ").'<strong>'.$exhibit->title.'</strong></a></div>';
        }
    }

    return $html;
}

function solr_tag_string()
{
    // Set the tag_delimiter option if no delimiter was passed.
    $delimiter ="";

    $tags = get_current_record('item')->Tags;

    if (empty($tags)) {
        return '';
    }

    $tagStrings = array();
    foreach ($tags as $tag) {
        $name = $tag['name'];
        $tagStrings[] = '<a href="'.url('/solr-search/?facet=tag:') . html_escape($name) . '" rel="tag">' . __(html_escape($name)) . '</a>';
    }
    return join(html_escape($delimiter), $tagStrings);
}
