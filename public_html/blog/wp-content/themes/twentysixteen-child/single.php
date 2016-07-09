<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<body <?php body_class(); ?>>

	<div class="header-container">
    	
        <a href="http://cuecountapp.com"><img src="/blog/wp-content/themes/twentysixteen-child/mainLogo.png" alt="Cue Count" class="mainLogo"/></a>
            
    </div>
    
    <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
				?>
                				
    		<div class="main-container" id="singleMain">
            
            <div class="topSection">
            	<a href="http://cuecountapp.com/blog">
            	<div class="homeButton">
                	<h3>Go To <br> Home</h3>
                
                </div>
                </a>
            	<a href="http://cuecountapp.com">
                <div class="ccButton">
                	<h3>Choice is a <br> Beautiful Thing</h3>
                
                </div>
                </a>
            
            </div>
            
                <?php
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
 
 	<?php get_footer(); ?>