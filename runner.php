<?php
date_default_timezone_set('America/New_York');
$posts = new SimpleXMLElement(file_get_contents('allPosts.xml'));
$itemArray = [];

foreach($posts->post as $p) {
 $title = $p->title;
  $tagArray = [];
  foreach($p->tags->tag as $t) {
   $tagArray[] = $t; 
  }
  foreach($p->attributes() as $k => $a) {
   if($k !== 'date') {
     continue;
   }
   $strdate = strtotime($a);
   exit;
  }
  //2018-02-22 08:10:00 convert time
  $pubDate = date("", $strdate);
}
                              
                              



?>
