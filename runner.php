<?php
date_default_timezone_set('America/New_York');
$posts = new SimpleXMLElement(file_get_contents('allPosts.xml'));
$utc_time = new DateTimeZone('UTC');
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
   $ny_time = new DateTime($a);
   $ny_time->setTimezone($utc_time);
   $pubDate = $datetime->format('D, d M Y H:i:s').' +0000';
   exit;
  }
  
}

echo '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0" xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:wp="http://wordpress.org/export/1.2/" ><channel>'..'</channel></rss>';
die();
                              



?>
