<?php
/*
PAGE STATIQUE
*/
get_header(); ?>

<div class="container">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="entry-header">
				<?php
				/*TITRE*/
					the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</header><!-- .entry-header -->

			<div class="hr"></div>

			<?php

			/*Breadcrumb yoast SEO*/
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('
				<p id="breadcrumbs">','</p>');
			}

			/*Image principale*/
			if ( ( is_single() || ( is_page() && ! greenpi_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
				echo '<div class="single-featured-image-header">';
				echo get_the_post_thumbnail( get_queried_object_id(), 'greenpi-featured-image' );
				echo '</div><!-- .single-featured-image-header -->';
			endif;

			/*Date*/
			if ( 'post' === get_post_type() ) {
				echo '<div class="entry-meta">';
						greenpi_posted_on();
				echo '</div><!-- .entry-meta -->';
			};
			?>

			<div class="entry-content">
				<div class="post-full-content">
					<?php 
					$content_post = get_post($my_postid);
					$content = $content_post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					echo $content;
					?>
				</div>	
			</div><!-- .entry-content -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer();
