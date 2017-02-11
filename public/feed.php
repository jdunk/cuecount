<?php

require_once(__DIR__ . '/start.php');

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
        <script src="/assets/jquery-1.11.3-jquery.min.js"></script>

        <link href="/assets/styles.css" rel="stylesheet" media="screen">

        <script src="/assets/masonry.pkgd.min.js"></script>
        <script src="/assets/imagesloaded.pkgd.min.js"></script>
        <script src="/cookies.js"></script>
        <script src="/assets/demo.js"></script>
        <link rel="canonical" href="http://cuecountapp.com/feed?id=<?= $row_1_id;?>">

        <meta name="viewport" content="width=device-width">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Place your vote!">
        <meta name="twitter:description" content="Cue Count"/>
        <meta name="twitter:site" content="http://cuecountapp.com/feed">
        <meta name="twitter:creator" content="@CueCount">
        <meta name="twitter:image"
            content="http://cuecountapp.com/<?= $row_1_post_image_path;?>"/>
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
        <img src="/assets/mainLogo.png" class="company_logo" alt="Cue Count App"/>
        <h1>Choice is a beautiful thing</h1>
        <p>Share your daily decisions<br> and vote on others. <a href="/about" target="_blank">Learn more</a></p>
        <a href="#popup1"><p class="cc_button red_flare">Get New Choices Everyday <img src="/assets/email.png" class="icon ic_1"/></p></a>
    </header>
<?php

$dPosts = get_decision_posts(null, empty($_GET['id']) ? null : $_GET['id']);

echo Twig::render('decision-posts', ['dPosts' => $dPosts]);

?>	
</div> <!-- = = END OF GRID = = -->

<button class="section_loadmore loadmore">
    <p>Loadmore <img src="/assets/refresh-round-symbol.png" class="icon"/></p> <!--ITEM LOADMORE-->
</button>

<a href="#popup1" class="bottom_subscribe red_flare">
    <p>Get New Choices Everyday</p>
</a>
    
</div> <!-- CONTAINER -->

<div id="popup1" class="overlay">
    <div class="popup">
        <a class="close" href="#"><img src="/assets/cancel.png"></a>
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

$(function() {
    var $container = $('.grid');
    $container.masonry({
        isFitWidth: true,
        itemSelector: '.item'
    });

    $('.loadmore').click(function(){
        var val = $('.final').attr('val');
        $.get(
            '/feed/more/' + (val-1),
            function(loadMoreResponse) {
                if(loadMoreResponse.length)
                {
                    $('.final').remove();
                    $(".grid").append(loadMoreResponse).each(function(){
                        $('.grid').masonry('reloadItems');
                    });
                    $container.masonry();
                }
                else
                {
                    $('<div class="well">Oh Damn! No more decisions right now. <br> <a href="http://cuecountapp.com/home">Post Your Own and Add to the Community :)</a></div>').insertBefore('.loadmore');
                    $('.loadmore').remove();
                }
            }
        );
    });
});

function show_extended_data(e){
    e.preventDefault();
    $(e.currentTarget).siblings(".chart").css("display","none");
    $(e.currentTarget).siblings(".results_message").css("display","none");
}

function castDecisionPostVote(e, decisionPostId, leftOrRight) {
    e.preventDefault();

    // Validation: leftOrRight must be 'l' or 'r'
    if (leftOrRight !== 'l' && leftOrRight !== 'r') {
        return;
    }

    $($('#object', $(e.currentTarget).closest("article"))).addClass("expandUp");

    // == == == SHOW RESULTS
    $(e.currentTarget).parents('.vote_wrap').hide();
    $('.vote_result_animation', $(e.currentTarget).closest("article")).show();

    // == == == PUT INDIVIDUAL RESULTS IN BOTTOM
    $('.vote_result_1', $(e.currentTarget).closest("div.vote_wrap")).text($(e.currentTarget).siblings("input[name='post_answer_L']").val());
    $('.vote_result_3', $(e.currentTarget).closest("div.vote_wrap")).text($(e.currentTarget).siblings("input[name='post_answer_R']").val());

    // == == == UPDATE PERCENTAGES
    $('.doughnutChart', $(e.currentTarget).closest("article")).drawDoughnutChart([
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text1']").val()), color: "#BC98D3" },
        { title: "", value: Number($(e.currentTarget).siblings("input[name='post_answer_text3']").val()), color: "#FF4D4D" }
    ]);

    // == == == VOTE ANIMATION - BOUNCE
    $(e.currentTarget).closest("div.item").addClass('animation-target');

    jQuery.post(
        '/decision-posts/' + decisionPostId + '/vote',
        {
            value: leftOrRight
        }
    ).fail(function() {
        // Action to handle failed vote request here
    });
}

</script>
<script src='https://cdn.jsdelivr.net/mojs/0.265.6/mo.min.js'></script>
<script src='https://cdn.jsdelivr.net/mojs-player/0.43.15/mojs-player.min.js'></script>
<script src="/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<script src="/assets/animation.js"></script>
</body>
</html>
