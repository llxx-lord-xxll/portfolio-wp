<?php get_header(); ?>

<?php
$posts_page = get_option( 'page_for_posts' );
?>
<section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
    <h1>MY <span>BLOG</span></h1>
    <?php if ($posts_page): ?>
    <span class="title-bg"><?php the_field('subtitle',$posts_page); ?></span>
    <?php endif; ?>
</section>

<section class="main-content revealator-slideup revealator-once revealator-delay1">
    <div class="container">
        <!-- Articles Starts -->
        <div class="row">

			<?php get_template_part( 'loop' ); ?>

			<?php get_template_part( 'pagination' ); ?>

        </div>
        <!-- Articles Ends -->
    </div>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
