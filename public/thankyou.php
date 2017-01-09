<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('blog/wp-blog-header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="cue,count,choice,cuecount.com,decision,participate,vote,score,tally,daily,discover">
    <meta name="description" content="Cue Count; Choice is beautiful">
    <meta name="author" content="">

    <title>Cue Count; Choice is beautiful</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Muli:300,400,600,700' rel='stylesheet' type='text/css'>
    
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/thankyou_creative.css" type="text/css">
</head>

<body>

    <header>
            
        <img src="img/mainLogo.png" class="mainLogo"/>
                
        <div class="header-content">
            <div class="header-content-inner">
            
                <div class="backdropText">
                    <h1>You Just Helped</h1>
                    <h1>Make This Happen :)</h1><h1>Thank You</h1>
                    <hr>
                    <p>Later this year you'll be able to experience Cue Count 1.0! Meanwhile we'll keep you updated, but we won't bother you too much.</p>
                </div>
                                                                    
                <a href="#blogSec" class="btn btn-primary btn-xl page-scroll">Read Our Minds<br>&darr;</a>
                
            </div>
        </div>
                
    </header>
    
    <!-- = = = = = = = = BLOG WIDGET = = = = = = = = = -->
    
    <div class="blogInset" id="blogSec">
    	<h3>Our Choices: Latest Thoughts</h3>
        <br>
		<hr class="light">
        <br>
        <div class="sliderNEWS">
            <ul>
				<?php
                // Get the last 3 posts.
                global $post;
                $args = array( 'posts_per_page' => 3 );
                $myposts = get_posts( $args );
                foreach( $myposts as $post ) :	setup_postdata($post); 
				?>
            	<li class="IMAGE">
           			<p> 
						<?php 
						the_title();
						the_excerpt( sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
							get_the_title()
						) ); 
						?> 
                    </p>
            	</li>
          	    <?php endforeach; ?>
            </ul>
            <button class="prev"><p class="sliderNEWSp">&#8249;</p></button>
            <button class="next"><p class="sliderNEWSp">&#8250;</p></button>
    	</div>
    </div>
    
    <footer>
		<p class="footerLp">Cue Count site created using Bootstrap</p>
        <a href="mailto:info@cuecountapp.com">
        	<p class="footerRp">Contact / Send Feedback</p>
        </a>    
    </footer>
	
    <!-- FACEBOOK SHARE -->
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=447004175458207";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- GOOGLE ANALYTICS -->
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-73431364-1', 'auto');
	  ga('send', 'pageview');
	</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>
</body>
</html>