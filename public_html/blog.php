<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('blog/wp-blog-header.php');
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cue Count Thoughts</title>
</head>

<body>


<p>This is A test</p>

				<?php
					// Get the last 3 posts.
					global $post;
					$args = array( 'posts_per_page' => 10 );
					$myposts = get_posts( $args );
					
					foreach( $myposts as $post ) :	setup_postdata($post); ?>
                    <?php the_title( sprintf('<h1 class="entry-title"><a href="%s">',esc_url( get_permalink() ) ), '</a></h1>' ); ?>
                    
                    <hr>
 				    <?php endforeach; ?>

				

</body>
</html>