<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Untitled Document</title>

 	<!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Muli:300,400,600,700' rel='stylesheet' type='text/css'>
	
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

	<div class="header-container">
    	
        <img src="wp-content/themes/twentysixteen-child/mainLogo.png" alt="Cue Count" class="mainLogo"/>
            
    </div>
    
    <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
    		<div class="main-container">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
        
                    // Include the single post content template.
                    get_template_part( 'template-parts/content', 'single' );
        
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
        
                    if ( is_singular( 'attachment' ) ) {
                        // Parent post navigation.
                        the_post_navigation( array(
                            'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
                        ) );
                    } elseif ( is_singular( 'post' ) ) {
                        // Previous/next post navigation.
                        the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                        ) );
                    }
        
                    // End of the loop.
                endwhile;
                ?>
        
            </div><!-- .main-area -->
        
        </main><!-- .site-area -->
        
	</div><!-- .content-area -->
    
</body>
</html>
