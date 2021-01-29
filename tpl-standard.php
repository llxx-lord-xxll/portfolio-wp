<?php
/* Template Name: Standard Template */

?>
<?php get_header(); ?>

        <section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
            <h1><?php echo get_the_title() ?></h1>
            <span class="title-bg"><?php the_field('subtitle'); ?></span>
        </section>
		<?php if ( have_posts()) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
		<?php endwhile; ?>

		<?php else : ?>

			<!-- article -->
			<article>

				<h2><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
