<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage greenpi
 * @since 1.0
 * @version 1.0
 * 
 * Page catégorie
 */

get_header(); ?>

<div class="container">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
			<div class="hr"></div>
		</header><!-- .page-header -->
	<?php endif; ?>

	<?php
		/*Breadcrumb yoast SEO*/
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('
			<p id="breadcrumbs">','</p>');
		}
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php

			if ( have_posts() ) :	

				while ( have_posts() ) : the_post();

					$categories = get_the_category(); 
					$cat_name = $categories[0]->cat_name;
					/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
				
					get_template_part( 'template-parts/post/content', get_post_format() );
				
				endwhile;

				the_posts_pagination( array(
					'prev_text' => greenpi_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'greenpi' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'greenpi' ) . '</span>' . greenpi_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'greenpi' ) . ' </span>',
				) );

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer();
