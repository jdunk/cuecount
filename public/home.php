<?php
session_start();
/* = = = = = = = = = = = = = =  
CONNECT TO USER TBL WITH THIS: 
= = = = = = = = = = = = = = = */
require_once 'class.user.php';
$user = new USER;

if(!$user->is_logged_in())
{
    header("Location: /index.php");
    exit;
}

$stmt = $user->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

/* = = = = = = = = = = = = = =  
CONNECT TO UPLOAD TBL WITH THIS:
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

if (isset($_REQUEST['submit_yn']))
{
    $imgtmp = addslashes($_FILES['post_imageO']['tmp_name']);
    $image_name = addslashes($_FILES['post_imageO']['name']);
    $image_type = addslashes($_FILES['post_imageO']['type']);
    $image_path = "uploads/".$image_name;
    $image_size = getimagesize($_FILES['post_imageO']['tmp_name']);

    if (!$image_size)
    {
        $uploadResultMessage = 'That\'s not an image';
    }
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

        move_uploaded_file($imgtmp, __DIR__ . '/' . $image_path);

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

        $uploadResultMessage = 'Uploaded Successfully!';
    }
}
elseif (isset($_REQUEST['submit_c']))
{
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

    if (!$image_size_L && !$image_size_R)
    {
        $uploadResultMessage = 'That\'s not an image';
    }
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

        $uploadResultMessage = 'Uploaded Successfully!';
    }
}

?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Cue Count: <?= $userData['userEmail'] ?></title>
        <script src="assets/jquery-1.11.3-jquery.min.js"></script>
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <script src="assets/animation.js"></script>
        <meta name="viewport" content="width=device-width">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="<?= $current_image_path ?>" />
        <script src="scripts.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        <script src="assets/masonry.pkgd.min.js"></script>
        <script src="assets/imagesloaded.pkgd.min.js"></script>
    </head>
<body class="fade-in one">
<div class="container">
    
<div class="grid">
    <div class="grid-sizer"></div>
    <header class="item">
        <img src="assets/mainLogo.png" class="company_logo" alt="Cue Count App"/>
        <h1>Choice is a beautiful thing</h1>
        <p>Share your daily decisions<br> and vote on others. <a href="http://cuecountapp.com/about" target="_blank">Learn more</a></p> 
        <a href="feed.php"><p class="cc_button" style="float:left;">Vote</p></a>
        <div class="prof_email"><?= $userData['userEmail'] ?></div>
        <a href="logout.php"><p class="cc_button">Logout</p></a>
    </header>
	
    <article class="item">
        <div class="upload_choice" id="upload_choice">
            <h3>Upload a Current Decision:</h3>
            <p class="cc_button" onClick="form_show('yn_upload','upload_choice')">Yes/No <br>(Single Image)
                <br>
                <img src="assets/single_upload.png" alt=""/>
            </p>
            <br>
            <p class="cc_button" onClick="form_show('c_upload','upload_choice')">Choose Either <br>(Double Image)
                <br>
                <img src="assets/double_upload.png" alt=""/>
            </p>
        </div>
        <form action="home.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="post_type" value="post_YN"/><!-- = = = = POST TYPE = = = = -->
            <input type="hidden" name="post_fname" value="<?= $userData['userName'] ?>"/><!-- = = = = FIRST NAME = = = = -->
            <input type="hidden" name="post_email" value="<?= $userData['userEmail'] ?>"/><!-- = = = = ACCOUNT EMAIL = = = = -->
            <input type="hidden" name="post_answerR" value="&#10003;"/><!-- = = = = "YES" = = = = -->
            <input type="hidden" name="post_answerL" value="&#215;"/><!-- = = = = "NO" = = = = -->
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
            <input type="hidden" name="post_fname" value="<?= $userData['userName'] ?>"/><!-- = = = = FIRST NAME = = = = -->
            <input type="hidden" name="post_email" value="<?= $userData['userEmail'] ?>"/><!-- = = = = ACCOUNT EMAIL = = = = -->
            <input type="hidden" name="post_answerR" value="&#10003;"/><!-- = = = = "Right" = = = = -->
            <input type="hidden" name="post_answerL" value="&#10003;"/><!-- = = = = "Left" = = = = -->
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

if (!empty($uploadResultMessage)) {
    echo '<div class="echoMessage">' . $uploadResultMessage . '</div>';
}

// Show decision_posts...

$sql="SELECT * FROM decision_post WHERE post_email='".$userData['userEmail']."' ORDER BY id DESC";
$result = mysqli_query($conn3, $sql);

while($dPost=mysqli_fetch_assoc($result))
{
    foreach ($result as $dPost)
    {
        $count = $dPost['post_answer1']+$dPost['post_answer2']+$dPost['post_answer3'];
        $vote_1_percent = round($dPost['post_answer1']*100/$count) . "%";
        $vote_2_percent = round($dPost['post_answer2']*100/$count) . "%";
        $vote_3_percent = round($dPost['post_answer3']*100/$count) . "%";

        ?>
	
	<div class="item" id="item">

	<a class="twitter"
	href="https://twitter.com/intent/tweet?text=<?= rawurlencode($dPost['post_content']) ?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?= $dPost['id'] ?>" 
	target="_blank">	
	<p><img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/></p>
	</a>
	
        <article>
    
            <div class="post_question">
                <div class="post_content"><?= $dPost['post_content'] ?></div>
                <?php

                if(empty($dPost['post_endpost']))
                {
                    ?>
                    <div class="endpost">
						<form action="" method="post">
							<input type="hidden" id="" value=" <?= $dPost['id'] ?> " name="endpost_id"/>
							<input type="submit" name="post_endpost" class="delete_btn_home" value="End Voting"/>
						</form>
					</div>
					<?php } else { ?> 
					<div class="endpost">
						<div class="post_ended">Vote Ended</div>
					</div>
                    <?php
                }
            ?>
            </div>

            <div class="post_imageO">
                <object data="<?= urlencode($dPost['post_imageO_path']) ?>" type='image/jpg'></object>
                <object data="<?= urlencode($dPost['post_imageL_path']) ?>" class='feed_img_L' type='image/jpg'></object>
                <object data="<?= urlencode($dPost['post_imageR_path']) ?>" class='feed_img_R' type='image/jpg'></object>

                <div id="vote_result_animation" class="fade-in one">
                    <div id="doughnutChart" class="chart"></div>
                </div>
            </div>

            <p class="current_resultShow" onclick="results_show(event)">Current Results</p>

            <div class="vote_result_1"><?= $vote_1_percent ?></div>
            <div class="vote_result_3"><?= $vote_3_percent ?></div>

            <input type="hidden" name="post_answer_text1" value="<?= $dPost['post_answer1'] ?>"/> <!--L-->
            <input type="hidden" name="post_answer_text3" value="<?= $dPost['post_answer3'] ?>"/> <!--R-->
        </article>
	
	</div> <!-- ITEM END -->
		
	<?php
    }
}

?>
</div> <!-- = = END OF GRID = = -->

</div> <!-- CONTAINER -->

<script type="text/javascript">

$(window).load(function() {
    $('.grid').masonry({
        itemSelector: '.item',
        isAnimated: true,
        isFitWidth: true
    });
});

</script>

</body>
</html>
