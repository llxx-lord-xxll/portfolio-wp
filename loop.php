<?php if (have_posts()): while (have_posts()) : the_post(); ?>


    <div id="post-<?php the_ID(); ?>" class="col-12 col-md-6 col-lg-6 col-xl-4 mb-30" <?php //post_class('col-12 col-md-6 col-lg-6 col-xl-4 mb-30') ?> >
        <article class="post-container">
            <div class="post-thumb">
                <a class="d-block position-relative overflow-hidden" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail( array( 350, 350 ) ); // Declare pixel size you need inside the array. ?>
                </a>
            </div>
            <div class="post-content">
                <div class="entry-header">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a></h3>
                </div>
                <div class="entry-content open-sans-font">
                    <p>
                        <?php the_excerpt() ?>...
                    </p>
                </div>
            </div>
        </article>
    </div>

<?php endwhile; ?>

<?php else : ?>

	<!-- article -->
	<article>
		<h2><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
