<?php
session_start();
/* = = = = = = = = = = = = = =  
CONNECT TO USER TBL WITH THIS: 
= = = = = = = = = = = = = = = */
require_once 'class.user.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{$user_home->redirect('index.php');}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Cue Count: <?php echo $row['userEmail']; ?></title>
		<script src="assets/jquery-1.11.3-jquery.min.js"></script>
		<link href="assets/styles.css" rel="stylesheet" media="screen">
		<script src="assets/animation.js"></script>
		<meta name="viewport" content="width=device-width">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:image" content="<?php echo $current_image_path ?>" />
		<script src="scripts.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/scripts.js"></script>
		<script src="assets/masonry.pkgd.min.js"></script>
		<script src="assets/imagesloaded.pkgd.min.js"></script>
    </head>
<body class="fade-in one">
<?php //require_once 'cache_head.php';?>
<div class="grid">
	<div class="grid-sizer"></div>
	<header class="item">
		<img src="assets/mainLogo.png" class="company_logo" alt="Cue Count App"/>
    	<h1>Choice is a beautiful thing</h1>
        <p>Share your daily decisions<br> and vote on others. <a href="http://cuecountapp.com/about" target="_blank">Learn more</a></p> 
        <a href="feed.php"><p class="cc_button" style="float:left;">Vote</p></a>
        <div class="prof_email"><?php echo $row['userEmail']; ?></div>
        <a href="logout.php"><p class="cc_button">Logout</p></a>
	</header>
    <article class="item">
    	<div class="upload_choice" id="upload_choice">
            <h3>Upload a Current Decision:</h3>
            <p class="cc_button" onClick="form_show('yn_upload','upload_choice')">Yes/No (Single Image)</p>
            <br>
            <p class="cc_button" onClick="form_show('c_upload','upload_choice')">Choice (Double Image)</p>
        </div>
        <form action="home.php" method="post" enctype="multipart/form-data">
		    <input type="hidden" name="post_type" value="post_YN"/><!-- = = = = POST TYPE = = = = -->
	        <input type="hidden" name="post_fname" value="<?php echo $row['userName']; ?>"/><!-- = = = = FIRST NAME = = = = -->	
	        <input type="hidden" name="post_email" value="<?php echo $row['userEmail']; ?>"/><!-- = = = = ACCOUNT EMAIL = = = = -->	
	        <input type="hidden" name="post_answerR" value="Yes"/><!-- = = = = "YES" = = = = -->	
	        <input type="hidden" name="post_answerL" value="No"/><!-- = = = = "NO" = = = = -->	
	        <input type="hidden" name="post_answer1" value="1"/><!-- = = = = "1" = = = = -->	
	        <input type="hidden" name="post_answer2" value="1"/><!-- = = = = "1" = = = = -->	
	        <input type="hidden" name="post_answer3" value="1"/><!-- = = = = "1" = = = = -->
            <div id="yn_upload">
	            <section class="upload_question">
                	<!-- = = = = 
                      QUESTION
                      = = = = -->
	            	<p><textarea name="post_content" class="question_textarea" maxlength="70" placeholder="Ask away, don't be bland, be weird :)" required></textarea></p>
	            </section>
	            <div class="yn_image">
	            	<!-- = = = = 
                       PICTURE 
                      = = = = -->
				      <input type="file" name="post_imageO" id="imgInp" accept="image/*" class="upload_img_btn" onchange="loadFile(event);"/>
				      <img class="preview" id="preview" alt=""/>
                </div>
				<p class="upload_back" onClick="form_show('upload_choice','yn_upload')">Back</p> 
				<input type="submit" class="cc_sumbit" name="submit_yn" value="Submit"/>        
	        </div>
    	</form>
        <form action="home.php" method="post" enctype="multipart/form-data">
        	<input type="hidden" name="post_type" value="post_C"/><!-- = = = = POST TYPE = = = = -->
	        <input type="hidden" name="post_fname" value="<?php echo $row['userName']; ?>"/><!-- = = = = FIRST NAME = = = = -->	
	        <input type="hidden" name="post_email" value="<?php echo $row['userEmail']; ?>"/><!-- = = = = ACCOUNT EMAIL = = = = -->	
	        <input type="hidden" name="post_answerR" value="Right"/><!-- = = = = "Right" = = = = -->	
	        <input type="hidden" name="post_answerL" value="Left"/><!-- = = = = "Left" = = = = -->	
	        <input type="hidden" name="post_answer1" value="1"/><!-- = = = = "1" = = = = -->	
	        <input type="hidden" name="post_answer2" value="1"/><!-- = = = = "1" = = = = -->	
	        <input type="hidden" name="post_answer3" value="1"/><!-- = = = = "1" = = = = -->
	    	<div id="c_upload">
	        	<section class="upload_question">
                	<!-- = = = = 
                      QUESTION
                      = = = = -->
	            	<p><textarea name="post_content" class="question_textarea" maxlength="70" placeholder="Ask away, don't be bland, be weird :)" required></textarea></p>
	            </section>
	            <div class="c_image">
	            	<!-- = = = = 
                       PICTURE 
                      = = = = -->
				      <input type="file" name="post_imageL" id="imgInp_L" class="upload_img_btn" onchange="loadFile_L(event);"/>
				      <img class="preview_L" id="preview_L" alt=""/>
                </div>

                <div class="c_image">
	            	<!-- = = = = 
                       PICTURE 
                      = = = = -->
				      <input type="file" name="post_imageR" id="imgInp_R" class="upload_img_btn" onchange="loadFile_R(event);"/>
				      <img class="preview_R" id="preview_R" alt=""/>
                </div>
                <div class="c_button_wrap">
					<p class="upload_back" onClick="form_show('upload_choice','c_upload')">Back</p>
					<input type="submit" class="cc_sumbit" name="submit_c" value="Submit"/>  
				</div>      
	        </div>
    	</form>
        
    </article>

<?php
/* = = = = = = = = = = = = = =  
CONNECT TO UPLAD TBL WITH THIS: 
= = = = = = = = = = = = = = = */
require 'db_conn3.php';
/* = = = = = = = = = = = = = =  
     END VOTING WITH THIS: 
= = = = = = = = = = = = = = = */
if(isset($_POST['post_endpost'],$_POST['endpost_id'])) {
	$endpost_id = $_POST['endpost_id'];
	$endpost_query = "UPDATE decision_post set post_endpost=1 WHERE id = '".$endpost_id."' ";
	mysqli_query($conn3, $endpost_query);		
}
/* = = = = = = = = = = = = = =  
   UPLOAD YOUR FILE WITH THIS 
= = = = = = = = = = = = = = = */
$post_email = $_POST['post_email'];
$post_type = $_POST['post_type'];
$post_content = $_POST['post_content'];
$post_fname = $_POST['post_fname'];
$post_answerL = $_POST['post_answerL'];
$post_answerR = $_POST['post_answerR'];
$post_answer1 = $_POST['post_answer1'];
$post_answer2 = $_POST['post_answer2'];
$post_answer3 = $_POST['post_answer3'];

if (isset($_REQUEST['submit_yn'])) {
$imgtmp = addslashes($_FILES['post_imageO']['tmp_name']);
$image_name = addslashes($_FILES['post_imageO']['name']);
$image_type = addslashes($_FILES['post_imageO']['type']);
$image_path = "uploads/".$image_name;
$image_size = getimagesize($_FILES['post_imageO']['tmp_name']);			
if ($image_size == FALSE)
	{ echo '<div class="echoMessage">Thats not an image</div>'; }
	else
		{
			$stmt_uploadyn = $conn3->prepare("INSERT INTO decision_post (
															`post_type`, 
															`post_fname`,
															`post_email`, 
															`post_content`, 
															`post_imageO_name`, 
															`post_imageO_path`,
															`post_imageO_type`,
															`post_answerL`,
															`post_answerR`,
															`post_answer1`,
															`post_answer2`,
															`post_answer3`
															) 
												VALUES (
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														? 
														 )");
			$stmt_uploadyn->bind_param("sssssssssiii",
														$post_type,
														$post_fname,
														$post_email,
														$post_content,
														$image_name,
														$image_path,
														$image_type,
														$post_answerL,
														$post_answerR,
														$post_answer1,
														$post_answer2,
														$post_answer3
														);
			$stmt_uploadyn->execute();
			$stmt_uploadyn->close();
			move_uploaded_file($imgtmp,$image_path);
			include_once("img_resize.php");
			// ---------- Convert JPG --------
			$kaboom = explode(".", $image_name);
			$fileExt = $kaboom[1];
			if (strtolower($fileExt) != "jpg") {
			    $target_file = $image_path;
			    $new_jpg = "uploads/".$kaboom[0].".jpg";
			    $image_path = $new_jpg;
			    ak_img_convert_to_jpg($target_file, $new_jpg, $fileExt);
			}
			// ---------- Resize JPG --------
			$target_file = $image_path;
			$resized_file = $image_path;
			$wmax = 800;
			$hmax = 800;
			ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
			/* ---------- Crop JPG --------
			$target_file = $image_path;
			$thumbnail = $image_path;
			$wthumb = 780;
			$hthumb = 720;
			ak_img_thumb($target_file, $thumbnail, $wthumb, $hthumb, $fileExt);*/

			echo '<div class="echoMessage">Uploaded Successfully!</div>';
		}

}elseif (isset($_REQUEST['submit_c'])) {
$imgtmp_L = addslashes($_FILES['post_imageL']['tmp_name']);
$image_nameL = addslashes($_FILES['post_imageL']['name']);
$image_typeL = addslashes($_FILES['post_imageL']['type']);
$image_pathL = "uploads/".$image_nameL;
$image_size_L = getimagesize($_FILES['post_imageL']['tmp_name']);	
$imgtmp_R = addslashes($_FILES['post_imageR']['tmp_name']);
$image_nameR = addslashes($_FILES['post_imageR']['name']);
$image_typeR = addslashes($_FILES['post_imageR']['type']);
$image_pathR = "uploads/".$image_nameR;
$image_size_R = getimagesize($_FILES['post_imageR']['tmp_name']);
if ($image_size_L == FALSE && $image_size_R == FALSE)
	{ echo '<div class="echoMessage">Thats not an image</div>'; }
	else
		{
			$stmt_uploadyn = $conn3->prepare("INSERT INTO decision_post (
															`post_type`, 
															`post_fname`,
															`post_email`, 
															`post_content`, 
															`post_imageR_name`, 
															`post_imageR_path`,
															`post_imageR_type`,
															`post_imageL_name`, 
															`post_imageL_path`,
															`post_imageL_type`,
															`post_answerL`,
															`post_answerR`,
															`post_answer1`,
															`post_answer2`,
															`post_answer3`
															) 
												VALUES (
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														?, 
														? 
														 )");
			$stmt_uploadyn->bind_param("ssssssssssssiii",
														$post_type,
														$post_fname,
														$post_email,
														$post_content,
														$image_nameR,
														$image_pathR,
														$image_typeR,
														$image_nameL,
														$image_pathL,
														$image_typeL,
														$post_answerL,
														$post_answerR,
														$post_answer1,
														$post_answer2,
														$post_answer3
														);
			$stmt_uploadyn->execute();
			$stmt_uploadyn->close();
			move_uploaded_file($imgtmp_L,$image_pathL);
			move_uploaded_file($imgtmp_R,$image_pathR);
			include_once("img_resize.php");
			// ---------- Convert LEFT JPG --------
			$kaboom = explode(".", $image_nameL);
			$fileExt = $kaboom[1];
			if (strtolower($fileExt) != "jpg") {
			    $target_fileL = $image_pathL;
			    $new_jpg = "uploads/".$kaboom[0].".jpg";
			    ak_img_convert_to_jpg($target_fileL, $new_jpg, $fileExt);
			}
			// ---------- Convert RIGHT JPG --------
			$kaboom = explode(".", $image_nameR);
			$fileExt = $kaboom[1];
			if (strtolower($fileExt) != "jpg") {
			    $target_fileR = $image_pathR;
			    $new_jpg = "uploads/".$kaboom[0].".jpg";
			    ak_img_convert_to_jpg($target_fileR, $new_jpg, $fileExt);
			}
			// ---------- Resize LEFT JPG --------
			$target_file = $image_pathL;
			$resized_file = $image_pathL;
			$wmax = 800;
			$hmax = 800;
			ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
			// ---------- Resize RIGHT JPG --------
			$target_file = $image_pathR;
			$resized_file = $image_pathR;
			$wmax = 800;
			$hmax = 800;
			ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);

			echo '<div class="echoMessage">Uploaded Successfully!</div>';
		}
}
/* = = = = = = = = = = = = = =  
	ECHO OUT UPLOADES HERE 
= = = = = = = = = = = = = = = */
$result = mysqli_query($conn3, "SELECT * FROM decision_post WHERE post_email='".$row['userEmail']."' ORDER BY id DESC");
while($row=mysqli_fetch_assoc($result)) {	
	foreach ($result as $row) {
		$count = $row['post_answer1']+$row['post_answer2']+$row['post_answer3']; 
		$vote_1_percent = round($row['post_answer1']*100/$count) . "%";
		$vote_2_percent = round($row['post_answer2']*100/$count) . "%";
		$vote_3_percent = round($row['post_answer3']*100/$count) . "%";
		?>
		<article class="item">
			<div class="post_question">
				<?php echo  "<div class='post_content'>" . $row['post_content'] . "</div>";
				if(empty($row['post_endpost'])) { ?>
					<div class="endpost">
						<form action="" method="post">
							<input type="hidden" id="" value=" <?php echo $row['id'] ;?> " name="endpost_id"/>
							<input type="submit" name="post_endpost" class="delete_btn_home" value="End Voting"/>
						</form>
						<a class="twitter"
						href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row['id']; ?>" 
						target="_blank">	
							<p>Share your choice: <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/></p>
						</a>
					</div>
					<?php } else { ?> 
					<div class="endpost">
						<div class="post_ended">Vote Ended</div>
						<a class="twitter"
						href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row['id']; ?>" 
						target="_blank">	
							<p>Share the results: <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/></p>
						</a>
					</div>
				<?php } ?>
			</div>

			<div class="post_imageO jared-home">
				<?php echo "<object data=" . $row['post_imageO_path'] . " type='image/jpg'></object>";?>
				<?php echo "<object data=" . $row['post_imageL_path'] . " class='feed_img_L' type='image/jpg'></object>";?>
				<?php echo "<object data=" . $row['post_imageR_path'] . " class='feed_img_R' type='image/jpg'></object>";?>
				<div id="vote_result_animation" class="fade-in one">
					<div id="doughnutChart" class="chart"></div>
				</div>
			</div>
			<p class="current_resultShow" onclick="results_show(event)">Current Results</p>
			<div class="vote_result_1"><?php echo $vote_1_percent;?></div>
			<div class="vote_result_2"><?php echo $vote_2_percent;?></div>
			<div class="vote_result_3"><?php echo $vote_3_percent;?></div>
			<input type="hidden" name="post_answer_text1" value="<?php echo $row['post_answer1']; ?>"/> <!--L-->
			<input type="hidden" name="post_answer_text2" value="<?php echo $row['post_answer2']; ?>"/> <!--O-->
			<input type="hidden" name="post_answer_text3" value="<?php echo $row['post_answer3']; ?>"/> <!--R--> 	
		</article><?php
	}
}  
?>
</div> <!-- = = END OF GRID = = -->
<script type="text/javascript">
	$(window).load(function() {
		$('.grid').masonry({
		itemSelector: '.item',
		isAnimated: true,
		isFitWidth: true
		});
	});
</script> 
<?php //require_once 'cache_footer.php'; ?>
</body>
</html>
