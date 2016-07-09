<?php
// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {
  
  // Connect to MySQL
  $mysqli = new mysqli( 'localhost', 'root', 'root', 'cuecount_proto' );
  
  // Check our connection
  if ( $mysqli->connect_error ) {
    die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
  }
  
  // Insert our data
  $sql = "INSERT INTO decision_post ( 
                post_type,
  						  post_content, 
								post_imageL,
								post_imageR,
								post_fname, 
								post_timeframe,
								post_answer1,
								post_answer2 ) 
  
  VALUES ( '{$mysqli->real_escape_string($_POST['post_type'])}', 
  			 '{$mysqli->real_escape_string($_POST['post_content'])}', 
  			 '{$mysqli->real_escape_string($_POST['post_imageL'])}',
  			 '{$mysqli->real_escape_string($_POST['post_imageR'])}', 
			   '{$mysqli->real_escape_string($_POST['post_fname'])}', 
			   '{$mysqli->real_escape_string($_POST['post_timeframe'])}',
			   '{$mysqli->real_escape_string($_POST['post_answer1'])}',
			   '{$mysqli->real_escape_string($_POST['post_answer2'])}')";


         $file = $_FILES['post_imageO']['tmp_name'];
            if (!isset($file)) {
              echo 'Please Select an Image';
            }else {
              $image = addslashes(file_get_contents($_FILES['post_imageO']['tmp_name']));
              $image_name = addslashes($_FILES['post_imageO']['post_imageO_name']);
              $image_size = getimagesize($_FILES['post_imageO']['tmp_name']); 
              
              if ($image_size==FALSE)
                echo "That's not an image.";
              else {
                  INSERT INTO decision_post VALUES ('','','','',$image_name,$image);
                  echo 'Problem uploading image.';


                 }
              
  }
			
  $insert = $mysqli->query($sql);
  
  // Print response from MySQL
  if ( $insert ) {
    echo "Success! Row ID: {$mysqli->insert_id}";
  } else {
    die("Error: {$mysqli->errno} : {$mysqli->error}");
  }
  
  // Close our connection
  $mysqli->close();
}

?>