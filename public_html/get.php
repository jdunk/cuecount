<?php 
require_once 'class.user.php';

// Create connection
		$server   = "localhost";
		$database = "cuecount_proto";
		$username = "root";
		$password = "root";
	
        // Create connection
        $con=mysqli_connect($server, $username, $password, $database);

	
	// Check connection
    if (mysqli_connect_errno($con)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

$id = addslashes($_REQUEST('id'));

$image = mysqli_query("SELECT * FROM decision_post WHERE id=$id");
$image = mysqli_fetch_assoc($image);
$image = $image('post_imageO');

header("Content-type: image/jpeg");

echo $image;

	
										/*else {
											$lastid = mysqli_insert_id();
											echo '<img src=get.php?id=$lastid>';										
										}*/

?>