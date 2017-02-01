<?php
require 'db_conn3.php';
jdlog('here');
if (isset($_GET['id'])) {
jdlog('?id is set to ' . $_GET['id']);
    $userpost = htmlspecialchars($_GET['id']);
    $userquery = "SELECT * FROM decision_post WHERE id=$userpost";
    $result_userpost = mysqli_query($conn3,$userquery) or die ('error with query');
    while($row_1 =mysqli_fetch_assoc($result_userpost)) {
        $row_1_id .= $row_1['id'];
        if (empty($row_1['post_imageR_path'])) {
                $row_1_post_image_path .= $row_1['post_imageO_path'];
            } else {
                $row_1_post_image_path .= $row_1['post_imageR_path'];
            }
        $row_1_post_image_path = trim($row_1_post_image_path);
        break;
    }
}
else {
jdlog('?id is NOT set');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Cue Count: Feed</title>
        <script src="assets/jquery-1.11.3-jquery.min.js"></script>

        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="assets/chart.css">

        <script src="assets/animation.js"></script>
        <script src="assets/masonry.pkgd.min.js"></script>
        <script src="assets/imagesloaded.pkgd.min.js"></script>
        <script src="cookies.js"></script>
        <script src="assets/demo.js"></script>
        <script src="assets/mo.min.js"></script>
        <link rel="canonical" href="http://cuecountapp.com/feed.php?id=<?php echo $row_1_id;?>">

        <meta name="viewport" content="width=device-width">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Place your vote!">
        <meta name="twitter:description" content="Cue Count"/>
        <meta name="twitter:site" content="http://cuecountapp.com/feed.php">
        <meta name="twitter:creator" content="@CueCount">
        <meta name="twitter:image"
            content="http://cuecountapp.com/<?php echo $row_1_post_image_path;?>"/>
    </head>
<body class="fade-in one">
<?php include_once("analyticstracking.php") ?>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KNRP9X"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KNRP9X');</script>
<!-- End Google Tag Manager -->

<div class="container">
    
<div class="grid" id="load_data_table">
    <div class="grid-sizer"></div>
    <header class="item">
        <img src="assets/mainLogo.png" class="company_logo" alt="Cue Count App"/>
        <h1>Choice is a beautiful thing</h1>
        <p>Share your daily decisions<br> and vote on others. <a href="http://cuecountapp.com/about.php" target="_blank">Learn more</a></p>
        <a href="#popup1"><p class="cc_button red_flare">Get New Choices Everyday <img src="assets/email.png" class="icon ic_1"/></p></a>
    </header>
<?php
//require_once 'cache_head.php';
require_once 'class.user.php';
if (isset($_GET['id'])) {
    $userpost = htmlspecialchars($_GET['id']);
    $userquery = "SELECT * FROM decision_post WHERE id=$userpost";
    $result_userpost = mysqli_query($conn3,$userquery) or die ('error with query');
    while($row_1 =mysqli_fetch_assoc($result_userpost)) {
        $count = $row_1['post_answer1']+$row_1['post_answer2']+$row_1['post_answer3']; 
        $vote_1_percent = round($row_1['post_answer1']*100/$count) . "%";
        $vote_2_percent = round($row_1['post_answer2']*100/$count) . "%";
        $vote_3_percent = round($row_1['post_answer3']*100/$count) . "%";
        ?> 
        <input type="hidden" id="featPath" value="<?php echo $row_1['post_imageO_path'] ?>"></input>
        <article class="item">
          <div class="post_question">
          <?php echo  "<div class='post_content'>" . $row_1['post_content'] . "</div>";?>
            <div class="post_fname">
            <?php echo  "<div>- " . $row_1['post_fname'] . "</div>";?>
            </div>
                <a class="twitter"
                    href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row_1['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row_1['id']; ?>" 
                    target="_blank"> 
                    <img src="assets/social_tweet.png" alt="Tweet This" class="twitter_icon"/>
                </a>
                <a class="twitter" href="#next_post"> 
                    <div class="next-button">Next
                        <img src="assets/arrow-down.png" alt="Tweet This" class="twitter_icon"/>
                    </div>
                </a>
          </div>
                  <div class="post_imageO jared">
<?php jdlog([
'row_1' => $row_1
]); ?>
                    <?php

                    if (!empty($row_1['post_imageO_path'])) {
                        echo  "<object data='" . urlencode($row_1['post_imageO_path']) . "' type='image/jpg'></object>";
                    }
                    else {
                        if (!empty($row_1['post_imageL_path']))
                            echo  "<object data='" . urlencode($row_1['post_imageL_path']) . "' class='feed_img_L' type='image/jpg'></object>";
                        if (!empty($row_1['post_imageR_path']))
                            echo  "<object data='" . urlencode($row_1['post_imageR_path']) . "' class='feed_img_R' type='image/jpg'></object>";
                    }

                    ?>
                    <div id="vote_result_animation" class="fade-in one">
                    <a class="twitter"
                      href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($row['post_content']);?>%20http%3A%2F%2Fcuecountapp.com%2Ffeed.php%3Fid%3D<?php echo $row_1['id']; ?>" 
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
                    <?php $cookie_name = $row_1['id']; $cookie_value = 'true';
                    if (isset($_COOKIE[$row_1['id']])) { ?>
                    <p class="current_resultShow" onclick="results_show(event)">Current Results</p>
                    <div class="vote_result_1"><?php echo $vote_1_percent;?></div>
                    <div class="vote_result_2"><?php echo $vote_2_percent;?></div>
                    <div class="vote_result_3"><?php echo $vote_3_percent;?></div>
                    <input type="hidden" name="post_answer_text1" value="<?php echo $row_1['post_answer1']; ?>"/> <!--L-->
                    <input type="hidden" name="post_answer_text2" value="<?php echo $row_1['post_answer2']; ?>"/> <!--O-->
                    <input type="hidden" name="post_answer_text3" value="<?php echo $row_1['post_answer3']; ?>"/> <!--R--> 
                    <?php } else { ?>
                    <form action="feed.php" method="post" class="vote_form">
                      <input type="hidden" name="input_id" class="input_id" value="<?php echo $row_1['id']; ?>"/> <!--ID-->
                      <input type="hidden" name="post_answer_L" value="<?php echo $vote_1_percent; ?>"/> <!--L-->
                      <input type="hidden" name="post_answer_O" value="<?php echo $vote_2_percent; ?>"/> <!--O-->
                      <input type="hidden" name="post_answer_R" value="<?php echo $vote_3_percent; ?>"/> <!--R--> 

                      <input type="hidden" name="post_answer_text1" value="<?php echo $row_1['post_answer1']; ?>"/> <!--L-->
                      <input type="hidden" name="post_answer_text2" value="<?php echo $row_1['post_answer2']; ?>"/> <!--O-->
                      <input type="hidden" name="post_answer_text3" value="<?php echo $row_1['post_answer3']; ?>"/> <!--R--> 
                        
                      <input type="submit" name="post_answer1" onclick="vote_1(event);SetCookie('<?php echo $row_1['id']; ?>','true',60);"
                           class="answer_L" id="<?php echo $row_1['id']; ?>" value="<?php echo $row_1['post_answerL']; ?>"/>

                      <input type="submit" name="post_answer2" onclick="vote_2(event);SetCookie('<?php echo $row_1['id']; ?>','true',60);"
                           class="answer_O" id="<?php echo $row_1['id']; ?>" value="I don't care"/>

                      <input type="submit" name="post_answer3" onclick="vote_3(event);SetCookie('<?php echo $row_1['id']; ?>','true',60);"
                           class="answer_R" id="<?php echo $row_1['id']; ?>" value=" <?php echo $row_1['post_answerR']; ?> "/>
                    </form>
                    <?php } ?>
                    <div class="vote_result_1"></div>
                    <div class="vote_result_2"></div>
                    <div class="vote_result_3"></div>   
                  </div>
        </article> 
        <?php
    }
}
require_once 'sql.php';	
echo $data;
require_once 'voting.php';
?>	
</div> <!-- = = END OF GRID = = -->

<button class="section_loadmore loadmore">
    <p>Loadmore <img src="assets/refresh-round-symbol.png" class="icon"/></p> <!--ITEM LOADMORE-->
</button>

<a href="#popup1" class="bottom_subscribe red_flare">
    <p>Get New Choices Everyday</p>
</a>
    
</div> <!-- CONTAINER -->

<div id="popup1" class="overlay">
    <div class="popup">
        <a class="close" href="#"><img src="assets/cancel.png"></a>
        <!-- Begin MailChimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
            /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
               We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>
        <div id="mc_embed_signup">
            <form action="//cuecountapp.us12.list-manage.com/subscribe/post?u=fedaa1e2502a0d6c416a38f28&amp;id=c5535f89be" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

                <h3>Fun Choices to Cast Your Vote On, Every Week!</h3>
                
                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                <div class="mc-field-group">
                    <label for="mce-EMAIL" class="emaillabel">Email Address  <span class="asterisk">*</span>
                </label>
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your Email">
                </div>
                <div class="mc-field-group input-group">
                    <strong>Your Interests </strong>
                    <ul><li><input type="checkbox" value="1" name="group[7457][1]" id="mce-group[7457]-7457-0"><label for="mce-group[7457]-7457-0">Women's Fashion</label></li>
                <li><input type="checkbox" value="2" name="group[7457][2]" id="mce-group[7457]-7457-1"><label for="mce-group[7457]-7457-1">Men's Fashion</label></li>
                <li><input type="checkbox" value="4" name="group[7457][4]" id="mce-group[7457]-7457-2"><label for="mce-group[7457]-7457-2">Photography</label></li>
                <li><input type="checkbox" value="8" name="group[7457][8]" id="mce-group[7457]-7457-3"><label for="mce-group[7457]-7457-3">Politics</label></li>
                <li><input type="checkbox" value="16" name="group[7457][16]" id="mce-group[7457]-7457-4"><label for="mce-group[7457]-7457-4">Graphic Design</label></li>
                <li><input type="checkbox" value="32" name="group[7457][32]" id="mce-group[7457]-7457-5"><label for="mce-group[7457]-7457-5">Modern/Fine Art</label></li>
                <li><input type="checkbox" value="64" name="group[7457][64]" id="mce-group[7457]-7457-6"><label for="mce-group[7457]-7457-6">Funny</label></li>
                <li><input type="checkbox" value="128" name="group[7457][128]" id="mce-group[7457]-7457-7"><label for="mce-group[7457]-7457-7">Interior Design</label></li>
                <li><input type="checkbox" value="256" name="group[7457][256]" id="mce-group[7457]-7457-8"><label for="mce-group[7457]-7457-8">Anything</label></li>
                </ul>
                </div>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_fedaa1e2502a0d6c416a38f28_c5535f89be" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
            </div>
            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            <!--End mc_embed_signup-->
            <br>
            <br>
            <hr>
            <a href="mailto:cuecount@gmail.com?Subject=New%20Beta%20User"><p style="text-align:center;font-size:0.8em;">Become a Beta User</p></a>
        </div>
</div>    

<script type="text/javascript">
$(window).load(function() {
    $('.grid').masonry({
    itemSelector: '.item',
    isAnimated: true,
    isFitWidth: true
    });
});
$( function() {
    var $container = $('.grid');
    $container.masonry({
        isFitWidth: true,
        itemSelector: '.item'
    });
    $('.loadmore').click(function(){
        var val = $('.final').attr('val');
        $.post('sql.php',{'to':val},function(data){
        if(!isFinite(data))
        {
            $('.final').remove();
            $(".grid").append(data).each(function(){
                $('.grid').masonry('reloadItems');
                });
            $container.masonry();
        }
        else
        {
            $('<div class="well">Oh Damn! No more decisions right now. <br> <a href="http://cuecountapp.com/home.php">Post Your Own and Add to the Community :)</a></div>').insertBefore('.loadmore');
            $('.loadmore').remove();
        }
    });
});
});

function show_extended_data(e){
    e.preventDefault();
    $(e.currentTarget).siblings(".chart").css("display","none");
    $(e.currentTarget).siblings(".results_message").css("display","none");
    $(e.currentTarget).siblings("#chart").css("display","block");
}

function vote_1(e) {
    e.preventDefault();
    $($('#object', $(e.currentTarget).closest("article"))).addClass("expandUp");
    // == == == SHOW RESULTS
    $(e.currentTarget).parents('.vote_wrap').css("display","none");
    $($('#vote_result_animation', $(e.currentTarget).closest("article"))).css("display","block");
    // == == == PUT INDIVIDUAL RESULTS IN BOTTOM
    $($('.vote_result_1', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_L']").val());
    $($('.vote_result_2', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_O']").val());
    $($('.vote_result_3', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_R']").val());
    // == == == UPDATE PERCENTAGES
    $($('#doughnutChart', $(e.currentTarget).closest("article"))).drawDoughnutChart([
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text1']").val()), color: "#BC98D3" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text2']").val()), color: "#EADAE5" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text3']").val()), color: "#FF4D4D" }
    ]);
    // == == == VOTE ANIMATION - BOUNCE
    $(e.currentTarget).closest("div.item").addClass('animation-target');
    var input_id = $(e.currentTarget).attr('id');
    var post_answer1 = $("input[name='post_answer1']").val();
    jQuery.ajax({
        type: 'POST',
        url: 'feed.php',
        data: {input_id: input_id, post_answer1: post_answer1},
        cache: false,
        success: function() {}
    });
}
function vote_2(e) {
    e.preventDefault();
    $($('#object', $(e.currentTarget).closest("article"))).addClass("expandUp");
    // == == == SHOW RESULTS
    $(e.currentTarget).parents('.vote_wrap').css("display","none");
    $($('#vote_result_animation', $(e.currentTarget).closest("article"))).css("display","block");
    // == == == PUT INDIVIDUAL RESULTS IN BOTTOM
    $($('.vote_result_1', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_L']").val());
    $($('.vote_result_2', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_O']").val());
    $($('.vote_result_3', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_R']").val());
    // == == == UPDATE PERCENTAGES
    $($('#doughnutChart', $(e.currentTarget).closest("article"))).drawDoughnutChart([
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text1']").val()), color: "#BC98D3" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text2']").val()), color: "#EADAE5" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text3']").val()), color: "#FF4D4D" }
    ]);
    // == == == VOTE ANIMATION - BOUNCE
    $(e.currentTarget).closest("div.item").addClass('animation-target');
    var input_id = $(e.currentTarget).attr('id');
    var post_answer2 = $("input[name='post_answer2']").val();
    jQuery.ajax({
        type: 'POST',
        url: 'feed.php',
        data: {input_id:input_id, post_answer2:post_answer2},
        cache: false,
        success: function(){}
    });
}
function vote_3(e) {
    e.preventDefault();
    $($('#object', $(e.currentTarget).closest("article"))).addClass("expandUp");
    // == == == SHOW RESULTS
    $(e.currentTarget).parents('.vote_wrap').css("display","none");
    $($('#vote_result_animation', $(e.currentTarget).closest("article"))).css("display","block");
    // == == == PUT INDIVIDUAL RESULTS IN BOTTOM
    $($('.vote_result_1', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_L']").val());
    $($('.vote_result_2', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_O']").val());
    $($('.vote_result_3', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_R']").val());
    // == == == UPDATE PERCENTAGES
    $($('#doughnutChart', $(e.currentTarget).closest("article"))).drawDoughnutChart([
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text1']").val()), color: "#BC98D3" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text2']").val()), color: "#EADAE5" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text3']").val()), color: "#FF4D4D" }
    ]);
    // == == == VOTE ANIMATION - BOUNCE
    $(e.currentTarget).closest("div.item").addClass('animation-target');
    var input_id = $(e.currentTarget).attr('id');
    var post_answer3 = $("input[name='post_answer3']").val();
    jQuery.ajax({
        type: 'POST',
        url: 'feed.php',
        data: {input_id: input_id, post_answer3: post_answer3},
        cache: false,
        success: function(){}
    });
}  
</script>
<script src='https://cdn.jsdelivr.net/mojs/0.265.6/mo.min.js'></script>
<script src='https://cdn.jsdelivr.net/mojs-player/0.43.15/mojs-player.min.js'></script>
<script src="scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<script src="assets/animation.js"></script>
<?php // require_once 'cache_footer.php'; ?>
</body>
</html>
