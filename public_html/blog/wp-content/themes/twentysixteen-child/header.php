<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title> <?php if (is_home()) { echo bloginfo('name');
                        } elseif (is_404()) {
                        echo '404 Not Found';
                        } elseif (is_category()) {
                        echo 'Category:'; wp_title('');
                        } elseif (is_search()) {
                        echo 'Search Results';
                        } elseif ( is_day() || is_month() || is_year() ) {
                        echo 'Archives:'; wp_title('');
                        } else {
                        echo wp_title('');
                        }
                        ?></title>

 	<!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Muli:300,400,500,700' rel='stylesheet' type='text/css'>
	
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
    
</head>