<?php
date_default_timezone_set('America/New_York');
$posts = new SimpleXMLElement(file_get_contents('allPosts.xml'));
$utc_time = new DateTimeZone('UTC');
$itemArray = [];

foreach($posts->post as $p) {
 $itemString = '<item>';
 $title = strip_tags(htmlspecialchars_decode($p->title)) ;
 $itemString .= '<title>'.$title.'</title>';
  $tagArray = [];
  foreach($p->tags->tag as $t) {
   $tagArray[] ='<category domain="post_tag" nicename="'.$t.'"><![CDATA['.$t.']]></category>'; 
  }
 $itemString .= implode('',$tagArray);
  foreach($p->attributes() as $k => $a) {
   if($k !== 'date') {
     continue;
   }
   $ny_time = new DateTime($a);
   $ny_time->setTimezone($utc_time);
   $pubDate = $datetime->format('D, d M Y H:i:s').' +0000';
   exit;
  }
 $itemString .= '<pubDate>'.$pubDate.'</pubDate>';
 $itemString .= '<content:encoded><![CDATA['.htmlspecialchars_decode($p->body).']]></content:encoded>';
 $itemString .= '</item>';
 $itemArray[] = $itemString;
  
}

echo '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0" xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:wp="http://wordpress.org/export/1.2/" ><channel>'.implode('',$itemArray).'</channel></rss>';
die();
                              



?>
