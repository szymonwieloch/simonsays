<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SimonSays
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php
		if ( have_posts() ) : ?>
			<main class="wide-box">
				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
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
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
