<?php

function echo_up_to_5_decision_posts($max_id = null)
{
    require 'db_conn3.php';

    if ($max_id === null) {
        $max_id = get_max_decision_posts_id();
    }

    $query = "SELECT * FROM decision_post WHERE id <= $max_id AND post_endpost='' ORDER BY id DESC LIMIT 5";
    $result = mysqli_query($conn3, $query);
    $count = mysqli_num_rows($result);

    if (!$count) {
        return;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $count = $row['post_answer1'] + $row['post_answer3'];
        $vote_1_percent = round($row['post_answer1'] * 100 / $count) . "%";
        $vote_3_percent = round($row['post_answer3'] * 100 / $count) . "%";
        $id = $row['id'];

        ?>
        <div class="item" id="item">
            <a class="twitter"
               href="https://twitter.com/intent/tweet?text=<?= rawurlencode($row['post_content']) ?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed%3Fid%3D<?= $id ?>"
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

                    if (!empty($row['post_imageO_path'])) {
                        echo "<img src='" . htmlspecialchars($row['post_imageO_path']) . "' />";
                    } else {
                        echo "<img src='" . htmlspecialchars($row['post_imageL_path']) . "' class='feed_img_L' />";
                        echo "<img src='" . htmlspecialchars($row['post_imageR_path']) . "' class='feed_img_R' />";
                    }

                    ?>

                    <div class="vote_wrap">
                        <?php

                        $cookie_name = $id;
                        $cookie_value = 'true';

                        if (isset($_COOKIE[$id])) {
                            ?>
                            <p class="current_resultShow" onclick="results_show(event)" id="expandUpBtn">Current
                                Results</p>

                            <input type="hidden" name="post_answer_text1" value="<?= $row['post_answer1'] ?>"/> <!--L-->
                            <input type="hidden" name="post_answer_text2" value="<?= $row['post_answer2'] ?>"/> <!--O-->
                            <input type="hidden" name="post_answer_text3" value="<?= $row['post_answer3'] ?>"/> <!--R-->

                            <?php
                        } else {
                            ?>
                            <form action="/decision-posts/<?= $id ?>/vote" method="post" class="vote_form">
                                <input type="hidden" name="input_id" class="input_id" value="<?= $id ?>"/> <!--ID-->
                                <input type="hidden" name="post_answer_L" value="<?= $vote_1_percent ?>"/> <!--L-->
                                <input type="hidden" name="post_answer_R" value="<?= $vote_3_percent ?>"/> <!--R-->
                                <input type="hidden" name="post_answer_text1" value="<?= $row['post_answer1'] ?>"/>
                                <!--L-->
                                <input type="hidden" name="post_answer_text3" value="<?= $row['post_answer3'] ?>"/>
                                <!--R-->

                                <input type="submit" name="post_answer1"
                                       onclick="castDecisionPostVote(event, <?= $id ?>, 'l');
                                           ani(event);
                                           SetCookie('<?= $cookie_name ?>','<?= $cookie_value ?>',60);"
                                       class="answer_L icobutton" id="<?= $id ?> expandUpBtn"
                                       value="<?= $row['post_answerL'] ?>"/>

                                <input type="submit" name="post_answer3"
                                       onclick="castDecisionPostVote(event, <?= $id ?>, 'r');
                                           ani(event);
                                           SetCookie('<?= $cookie_name ?>','<?= $cookie_value ?>',60);"
                                       class="answer_R icobutton" id="<?= $id ?> expandUpBtn"
                                       value=" <?= $row['post_answerR'] ?> "/>
                            </form>
                            <?php
                        }

                        ?>
                    </div> <!-- .vote_wrap -->

                    <div id="vote_result_animation" class="fade-in one">

                        <div id="doughnutChart" class="chart"></div>

                        <a href="#popup1" class="twitter twitter_vote_center">
                            <img src="assets/email_white.png" alt="Tweet This" class="icon ic_1_inVote"/>
                        </a>

                        <a class="" href="#<?= $id - 1 ?>">
                            <div class="next-button">
                                <img src="assets/arrow-down.png" alt="Tweet This" class="twitter_icon"/>
                            </div>
                        </a>

                    </div> <!-- #vote_result_animation -->

                </div> <!-- .post_imageO -->

            </article>

        </div> <!-- #item.item -->
        <?php

    }

    echo '<div class="final" val="' . $id . '"></div>';
}

function get_max_decision_posts_id()
{
    require 'db_conn3.php';
    $result = mysqli_query($conn3, 'SELECT MAX(id) FROM decision_post');

    return mysqli_fetch_row($result)[0];
}

$max_id = null;

if (isset($_POST['to']))
{
    $max_id = $_POST['to'];
}

echo_up_to_5_decision_posts($max_id);
