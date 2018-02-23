<?php
/**
 * Template Name: NEW Media Stream
 */
date_default_timezone_set('America/New_York');


function createNew($files) {
 if(empty($files)) {
  return false;
 }
 $posts = new SimpleXMLElement(file_get_contents('post_file'));
 if(!$posts){return false;}
 
 $utc_time = new DateTimeZone('UTC'); 
 $postCount = count($posts->post);
 $successPosts = 0;
 foreach($posts->post as $p) {
  $title = strip_tags(htmlspecialchars_decode($p->title[0]));
  $tagArray = [];
  foreach($p->tags[0]->tag as $t) {
   $tagArray[] = $t;
  }
  foreach($p->attributes() as $k => $a) {
   if($k !== 'date') {
     continue;
   }
   $ny_time = new DateTime($a);
   $ny_time->setTimezone($utc_time);
   $pubDate = $datetime->format('Y-m-d H:i:s').' +0000';
   break;
  }
  if(!$pubDate){break;}
  $content = htmlspecialchars_decode($p->body[0]);
 
  $pid = wp_insert_post(array(
   'post_title'    =>   $title,
   'post_content'  =>   $content,
   'post_date'     =>   $pubDate,
   'post_status'   =>   'publish',
  ));
  if($pid) {
   $successPosts++;
   wp_set_post_tags($pid,$tagArray);
  }
 }
 if($successPosts === $postCount) {
  return true;
 }
 
}



$successFile = createNew($_FILES);

?>
<?php if(!$successFile): ?>
<form enctype="multipart/form-data" action="__URL__" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>                 
<?php endif;?>

<?php if($successFile):?>

<h1>Posts uploaded</h1>

<?php endif;?>


?>
