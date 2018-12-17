<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'greenpi' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">

			<?php the_custom_logo(); ?>

			<?php if ( ( greenpi_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
			<a href="#content" class="menu-scroll-down"><?php echo greenpi_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'greenpi' ); ?></span></a>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'top' ) ) : ?>
					<div class="navigation-top">
						<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
					</div><!-- .navigation-top -->
				<?php endif; ?>

		</div><!-- .container -->
	</header><!-- #masthead -->

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! greenpi_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'greenpi-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div id="content" class="site-content">