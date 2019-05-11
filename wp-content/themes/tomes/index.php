<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tomes
 */

get_header();
?>

	<div id="primary" class="content-area grid">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						
						<?php tomes_post_thumbnail(); ?>
						<div class="entry-meta">
						<?php 
						//meta data
						tomes_posted_on();
						tomes_posted_by();
						?>
						</div><!-- .entry-meta -->
						<a href="<?php the_permalink();?>">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</a>


							
						
					</header><!-- .entry-header -->
				</article>
				
			<?php
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
