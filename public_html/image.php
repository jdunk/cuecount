<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "cuecount_proto";
$dberror1 = "Couldn't find your Database";
$dberror2 = "Couldn't find your table";

$conn2 = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)or die($dberror1); 


header("Content-type: image/jpg");
echo $row['post_imageO'];

/*$image_post = mysqli_query("SELECT * FROM decision_post WHERE id=' . $post_id[$i] . '");

$image_post = mysqli_fetch_assoc($image_post);

$image_post = $image_post['post_imageO'];

header("Content-type: image/jpeg");
echo $image_post;*/



?>