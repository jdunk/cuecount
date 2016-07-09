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
    <link rel="stylesheet" href="css/creative.css" type="text/css">
</head>

<body>

    <header>
            
        <img src="img/mainLogo.png" class="mainLogo"/>
                
        <div class="header-content">
            <div class="header-content-inner">
            
                <div class="an_wrap">
                    <div id="anSprite"></div>
                </div>
                                                                        
                <div class="backdropText">
                    <h1>Choice</h1>
                    <h3>is a beautiful thing</h3>
                    <hr>
                    <p>Share your daily decisions and enrich others</p>
                </div>
                                                                    
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Try It<br>&darr;</a>
                
            </div>
        </div>
                
    </header>
    
    <!-- = = = = = = = = FIRST POINT = = = = = = = = = -->

    <section class="bg-primary" id="about">
    
    	<img src="img/iPad-Retina-Display-Mockup.png" alt="" class="ipad_mockup"/>
                        
        <img src="img/Apple-macbook-mockup.png" alt="" class="macbook_mockup"/>
    
        <div class="container">
            <h2 class="section-heading">Share/Browse Decisions.<br> Vote.<br> Find Some Motivation.</h2>
                                                                
            <hr class="light">
                                
            <p class="text-faded">We created this app as an experiment - believing people can discover inspiration through other's life decisions. With Cue Count you can browse people's daily choices around the world, and participate in them!
            </p>
            
            <br>
            <br>
            
            <div class="goToSubscribe">
            	<a href="#subscribe" class="btn btn-thirdly btn-xl page-scroll"><p>Get Onboard</p></a>
            </div>
            
            <div class="learnMore">
            	<a href="#secondary" class="btn btn-secondary btn-xl page-scroll"><p>Learn More</p></a>
            </div>
            
        </div>
    </section>
    
    <!-- = = = = = = = = SECOND POINT = = = = = = = = = -->

    <section class="bg-secondary" id="secondary">
        <div class="container">
            <h2 class="section-heading">An App for You to Vote on People's</h2><h2> Daily Choices Around the World, and</h2><h2> for them to Vote on Your's</h2>
                                
            <br>
            <hr class="light">
                                
            <p class="text-faded">Upload any decision you make and receive input! Whether it's a dress for a party, the color of your new carpet, a design project you've been working on, your next job, your next backpacking destination; you can get a yes/no response, or, upload two images and compare.
            </p>
            
            <br>
            <br>
            <div class="goToSubscribe">
            	<a href="#subscribe" class="btn btn-thirdly btn-xl page-scroll"><p>Get Onboard</p></a>
            </div>
            
        </div>
    </section>
    
    <!-- = = = = = = = = SUBSCRIBE = = = = = = = = = -->

    <section class="bg-thirdly" id="subscribe">
        <div class="container">
            <h2 class="section-heading">The Online Place to be a Human Being. Cue Count's Free & launching This Year!</h2>
            
            <a href="#subscribe"></a>
            
            <p class="text-faded">We are launching our first version this year;<br> you should be one of the first to experience it!
                                
            </p>
                                
            <div class="subscribe">
            	<?php include 'subscribe_widget.php' ?>
            </div>
                                
        </div>
    </section>
    
    <!-- = = = = = = = = BLOG WIDGET = = = = = = = = = -->
    
    <div class="blogInset">
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