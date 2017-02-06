<?php

class Feeds
{
    public function query($to)
    {
        require 'db_conn3.php';

        if (! $to) {
            echo '0';
            return;
        }

        $query = "SELECT * FROM decision_post WHERE id < $to AND post_endpost='' ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($conn3, $query);
        $count = mysqli_num_rows($result);

        if (! $count) {
            echo '0';
            return;
        }

        while($row = mysqli_fetch_assoc($result))
        {
            $count = $row['post_answer1']+$row['post_answer2']+$row['post_answer3'];
            $vote_1_percent = round($row['post_answer1']*100/$count) . "%";
            $vote_2_percent = round($row['post_answer2']*100/$count) . "%";
            $vote_3_percent = round($row['post_answer3']*100/$count) . "%";
            $id = $row['id'];

            ?>
            <div class="item" id="item">
                <a class="twitter"
                    href="https://twitter.com/intent/tweet?text=<?= rawurlencode($row['post_content']) ?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?= $id ?>"
                    target="_blank">
                    <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/>
                </a>

                <article>

                    <a name="<?= $id ?>"></a>

                    <div class="post_question">
                      <div class="post_content">
                          <?= $row['post_content'] ?>
                          <div class="post_fname">-<?= $row['post_fname'] ?></div>
                      </div>
                    </div>

                    <div class="post_imageO">

                    <?php

                    if (!empty($row['post_imageO_path']))
                    {
                        echo  "<object data='" . $row['post_imageO_path'] . "' type='image/jpg'></object>";
                    }
                    else
                    {
                        echo  "<object data='" . $row['post_imageL_path'] . "' class='feed_img_L' type='image/jpg'></object>";
                        echo  "<object data='" . $row['post_imageR_path'] . "' class='feed_img_R' type='image/jpg'></object>";
                    }

                    ?>

                    <div class="vote_wrap">
                    <?php

                    $cookie_name = $id;
                    $cookie_value = 'true';

                    if (isset($_COOKIE[$id]))
                    {
                    ?>
                      <p class="current_resultShow" onclick="results_show(event)" id="expandUpBtn">Current Results</p>

                      <input type="hidden" name="post_answer_text1" value="<?= $row['post_answer1'] ?>"/> <!--L-->
                      <input type="hidden" name="post_answer_text2" value="<?= $row['post_answer2'] ?>"/> <!--O-->
                      <input type="hidden" name="post_answer_text3" value="<?= $row['post_answer3'] ?>"/> <!--R-->

                    <?php
                    }
                    else
                    {
                    ?>
                      <form action="feed.php" method="post" class="vote_form">
                        <input type="hidden" name="input_id" class="input_id" value="<?= $id ?>"/> <!--ID-->
                        <input type="hidden" name="post_answer_L" value="<?= $vote_1_percent ?>"/> <!--L-->
                        <input type="hidden" name="post_answer_O" value="<?= $vote_2_percent ?>"/> <!--O-->
                        <input type="hidden" name="post_answer_R" value="<?= $vote_3_percent ?>"/> <!--R-->
                        <input type="hidden" name="post_answer_text1" value="<?= $row['post_answer1'] ?>"/> <!--L-->
                        <input type="hidden" name="post_answer_text2" value="<?= $row['post_answer2'] ?>"/> <!--O-->
                        <input type="hidden" name="post_answer_text3" value="<?= $row['post_answer3'] ?>"/> <!--R-->

                        <input type="submit" name="post_answer1"
                             onclick="vote_1(event);
                                      ani(event);
                                      SetCookie('<?= $cookie_name ?>','<?= $cookie_value ?>',60);"
                             class="answer_L icobutton" id="<?= $id ?> expandUpBtn" value="<?= $row['post_answerL'] ?>"/>

                        <input type="submit" name="post_answer2"
                             onclick="vote_2(event);
                                      ani(event);
                                      SetCookie('<?= $cookie_name ?>','<?= $cookie_value ?>',60);"
                             class="answer_O icobutton" id="<?= $id ?> expandUpBtn" value="&#8767;"/>

                        <input type="submit" name="post_answer3"
                             onclick="vote_3(event);
                                      ani(event);
                                      SetCookie('<?= $cookie_name ?>','<?= $cookie_value ?>',60);"
                             class="answer_R icobutton" id="<?= $id ?> expandUpBtn" value=" <?= $row['post_answerR'] ?> "/>
                      </form>
                    <?php
                    }

                    ?>
                    </div> <!-- .vote_wrap -->

                    <div id="vote_result_animation" class="fade-in one">

                      <div id="doughnutChart" class="chart"></div>

                      <a href="#" class="show_data" onclick="show_extended_data(event);">
                        <img src="assets/chart.png" alt="Tweet This" class="twitter_icon"/>
                      </a>

                      <a class="" href="#<?= $id-1 ?>">
                        <div class="next-button">
                          <img src="assets/arrow-down.png" alt="Tweet This" class="twitter_icon"/>
                        </div>
                      </a>

                      <div id="" class="" style="display:none;">
                        <div class="vote_result_1"><?= $vote_1_percent ?></div>
                        <div class="vote_result_2"><?= $vote_2_percent ?></div>
                        <div class="vote_result_3"><?= $vote_3_percent ?></div>
                      </div>

                    </div> <!-- #vote_result_animation -->
                    </div> <!-- .post_imageO -->

                </article>
            </div> <!-- #item.item -->
        <?php

        }

        return '<div class="final" val="' . $id . '"></div>';
    }

    public function main()
    {
        if (isset($_POST['to']))
        {
            echo $this->query($_POST['to']);
        }
        else
        {
            require_once 'get_max_id.php';
            $this->query($highest_id);
        }
    }
}	// FEEDS

$obj = new Feeds();
$obj->main();
