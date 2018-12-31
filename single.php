<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage greenpi
 * @since 1.0
 * @version 1.0
 * 
 * PAGE D'UN ARTICLE AVEC LOOP
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="entry-header">
				<?php
				/*TITRE*/
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} elseif ( is_front_page() && is_home() ) {
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
				?>
			</header><!-- .entry-header -->

			<div class="hr"></div>

			<?php
			if ( ( is_single() || ( is_page() && ! greenpi_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
				echo '<div class="single-featured-image-header">';
				echo get_the_post_thumbnail( get_queried_object_id(), 'greenpi-featured-image' );
				echo '</div><!-- .single-featured-image-header -->';
			endif;

			/*Date*/
			if ( 'post' === get_post_type() ) {
				echo '<div class="entry-meta">';
					if ( is_single() ) {
						greenpi_posted_on();
					} else {
						echo greenpi_time_link();
						greenpi_edit_link();
					};
				echo '</div><!-- .entry-meta -->';
			};
			?>

			<div class="entry-content">
				<div class="post-full-content">
					<?php echo get_post_field('post_content', $post_id); ?>
				</div>	
			</div><!-- .entry-content -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer();
