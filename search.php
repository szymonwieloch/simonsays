<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package SimonSays
 */

get_header(); ?>

	<section id="primary" class="content-area">

		<?php
		if ( have_posts() ) : ?>
			<main id="main" class="wide-box">
				<header class="page-header">
					<h1 class="page-title"><?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'simonsays' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
				</header><!-- .page-header -->

				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						//setup_postdata( $post );
						require get_template_directory() . '/inc/post-list.php';

					endwhile; 
				?>

				<div class="clear"></div>
			</main>
		<?php else :
			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
