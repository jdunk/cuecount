<?php
class feeds {
	public function query($to,$from) {
    require 'db_conn3.php'; 
		$query = "SELECT * FROM decision_post WHERE id<$from AND post_endpost='' ORDER BY id DESC LIMIT 5";
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
				<div class="item" id="item">
          <a class="twitter"
              href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row['id']; ?>" 
              target="_blank"> 
              <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/>
          </a>

        <article>

          <?php echo  "<a name='".$row['id']."'></a>";?>

            <div class="post_question">
              <?php echo  "<div class='post_content'>" . $row['post_content'] . " <div class='post_fname'>-" . $row['post_fname'] . "</div></div>";?>
            </div>

                  <div class="post_imageO">
                  <?php
                    if (!empty($row['post_imageO_path']))
                        echo  "<object data='" . $row['post_imageO_path'] . "' type='image/jpg'></object>";
                    else {
                        echo  "<object data='" . $row['post_imageL_path'] . "' class='feed_img_L' type='image/jpg'></object>";
                        echo  "<object data='" . $row['post_imageR_path'] . "' class='feed_img_R' type='image/jpg'></object>";
                    }
                    ?>

                    <div class="vote_wrap">
                      <?php $cookie_name = $row['id']; $cookie_value = 'true';
                      if (isset($_COOKIE[$row['id']])) { ?>
                          <p class="current_resultShow" onclick="results_show(event)" id="expandUpBtn">Current Results</p>

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
                          
                        <input type="submit" name="post_answer1" 
                              onclick="vote_1(event);
                                      ani(event);
                                      SetCookie('<?php echo $row['id']; ?>','true',60);"
                              class="answer_L icobutton" id="<?php echo $row['id']; ?> expandUpBtn" value="<?php echo $row['post_answerL']; ?>"/>

                        <input type="submit" name="post_answer2" 
                              onclick="vote_2(event);
                                      ani(event);
                                      SetCookie('<?php echo $row['id']; ?>','true',60);"
                             class="answer_O icobutton" id="<?php echo $row['id']; ?> expandUpBtn" value="&#8767;"/>

                        <input type="submit" name="post_answer3" 
                              onclick="vote_3(event);
                                      ani(event);
                                      SetCookie('<?php echo $row['id']; ?>','true',60);"
                             class="answer_R icobutton" id="<?php echo $row['id']; ?> expandUpBtn" value=" <?php echo $row['post_answerR']; ?> "/>
                      </form>
                      <?php } ?>
                        
                    </div>

                    <div id="vote_result_animation" class="fade-in one">

                      <div id="object" class="results_message">The Masses Agree with You!</div>

                      <div id="doughnutChart" class="chart"></div>

                      <div id="chart">
                        <ul id="numbers">
                          <li><span>NO</span></li>
                          <li><span>NUTRAL</span></li>
                          <li><span>YES</span>
                        </ul>
                      </div>

                      <a href="#" class="show_data" onclick="show_extended_data(event);">
                        <img src="assets/chart.png" alt="Tweet This" class="twitter_icon"/>
                      </a>

                      <a class="" href="#<?php echo $row['id']-1; ?>"> 
                        <div class="next-button">
                          <img src="assets/arrow-down.png" alt="Tweet This" class="twitter_icon"/>
                        </div>
                      </a>
                        
                      <div id="" class="" style="display:none;">
                        <div class="vote_result_1"><?php echo $vote_1_percent;?></div>
                        <div class="vote_result_2"><?php echo $vote_2_percent;?></div>
                        <div class="vote_result_3"><?php echo $vote_3_percent;?></div>
                      </div>

                    </div>
                  </div>
                  
                </article>
              </div>
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
			// "to" is really *from*
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