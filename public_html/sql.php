<?php
class feeds {
	public function query($to,$from) {
    require 'db_conn3.php'; 
		$query = "SELECT * from decision_post where id<$from and id>$to and post_endpost='' ORDER BY id DESC";
		$result = mysqli_query($conn3,$query);
		$count = mysqli_num_rows($result);
		$data = '';
		if($count>0)
		{
			while($row =mysqli_fetch_assoc($result))
			{
        $count = $row['post_answer1']+$row['post_answer2']+$row['post_answer3']; 
        $vote_1_percent = round($row['post_answer1']*100/$count) . "%";
        $vote_2_percent = round($row['post_answer2']*100/$count) . "%";
        $vote_3_percent = round($row['post_answer3']*100/$count) . "%";
			  $id = $row['id'];
			  $data = $data
	      ?> 
				<article class="item">
          <?php //echo  "<a".$row['id']."></a>";?>
          <div class="post_question">
            <?php echo  "<div class='post_content'>" . $row['post_content'] . "</div>";?>
            <div class="post_fname">
              <?php echo  "<div>-" . $row['post_fname'] . "</div>";?>
            </div>
            <a class="twitter"
                href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row['id']; ?>" 
                target="_blank"> 
              <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/>
            </a>
          </div>
                  <div class="post_imageO">
                  <?php
                    if (!empty($row['post_imageO_path']))
                        echo  "<object data=" . $row['post_imageO_path'] . " type='image/jpg'></object>";
                    else {
                        echo  "<object data=" . $row['post_imageL_path'] . " class='feed_img_L' type='image/jpg'></object>";
                        echo  "<object data=" . $row['post_imageR_path'] . " class='feed_img_R' type='image/jpg'></object>";
                    }
                    ?>
                    <div id="vote_result_animation" class="fade-in one">
                    <a class="twitter"
                      href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row['id']; ?>" 
                      target="_blank"> 
                      <div class="call-to-action">
                          Share this choice
                          <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/>
                      </div>
                    </a>
                      <div id="doughnutChart" class="chart"></div>
                    </div>
                  </div>
                  <div class="vote_wrap">
                    <?php $cookie_name = $row['id']; $cookie_value = 'true';
                    if (isset($_COOKIE[$row['id']])) { ?>
                    <p class="current_resultShow" onclick="results_show(event)">Current Results</p>
                    <div class="vote_result_1"><?php echo $vote_1_percent;?></div>
                    <div class="vote_result_2"><?php echo $vote_2_percent;?></div>
                    <div class="vote_result_3"><?php echo $vote_3_percent;?></div>
                    <input type="hidden" name="post_answer_text1" value="<?php echo $row['post_answer1']; ?>"/> <!--L-->
                    <input type="hidden" name="post_answer_text2" value="<?php echo $row['post_answer2']; ?>"/> <!--O-->
                    <input type="hidden" name="post_answer_text3" value="<?php echo $row['post_answer3']; ?>"/> <!--R--> 
                    <?php } else { ?>
                    <form action="feed.php" method="post" class="vote_form">
                      <input type="hidden" name="input_id" class="input_id" value="<?php echo $row['id']; ?>"/> <!--ID-->
                      <input type="hidden" name="post_answer_L" value="<?php echo $vote_1_percent; ?>"/> <!--L-->
                      <input type="hidden" name="post_answer_O" value="<?php echo $vote_2_percent; ?>"/> <!--O-->
                      <input type="hidden" name="post_answer_R" value="<?php echo $vote_3_percent; ?>"/> <!--R--> 

                      <input type="hidden" name="post_answer_text1" value="<?php echo $row['post_answer1']; ?>"/> <!--L-->
                      <input type="hidden" name="post_answer_text2" value="<?php echo $row['post_answer2']; ?>"/> <!--O-->
                      <input type="hidden" name="post_answer_text3" value="<?php echo $row['post_answer3']; ?>"/> <!--R--> 
                        
                      <input type="submit" name="post_answer1" onclick="vote_1(event);SetCookie('<?php echo $row['id']; ?>','true',60);"
                           class="answer_L" id="<?php echo $row['id']; ?>" value="<?php echo $row['post_answerL']; ?>"/>

                      <input type="submit" name="post_answer2" onclick="vote_2(event);SetCookie('<?php echo $row['id']; ?>','true',60);"
                           class="answer_O" id="<?php echo $row['id']; ?>" value="I don't care"/>

                      <input type="submit" name="post_answer3" onclick="vote_3(event);SetCookie('<?php echo $row['id']; ?>','true',60);"
                           class="answer_R" id="<?php echo $row['id']; ?>" value=" <?php echo $row['post_answerR']; ?> "/>
                    </form>
                    <?php } ?>
                    <div class="vote_result_1"></div>
                    <div class="vote_result_2"></div>
                    <div class="vote_result_3"></div>   
                  </div>
                </article>
				<?php ;
			}
			$data=$data.'<div class="final" val="'.$id.'" ></div>';
			return $data;
		}
		else
		{
			echo '0';
		}
	}
	public function main()
	{
		if(isset($_POST['to']))
		{
			$from=$_POST['to'];
      $to = $from-5;
      $data = $this->query($to,$from);
      echo $data;
		}
		else
		{
      require_once 'get_max_id.php';
      $parameter_id = $highest_id-6;
			$data = $this->query($parameter_id,$highest_id);
			return $data;
		}
	}
}	// FEEDS

$obj = new Feeds();
$data = $obj->main();
?>