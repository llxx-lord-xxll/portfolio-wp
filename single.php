<?php get_header(); ?>

<?php
$posts_page = get_option( 'page_for_posts' );
global $post;
?>
<section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
    <h1>MY <span>BLOG</span></h1>
    <?php if ($posts_page): ?>
        <span class="title-bg"><?php the_field('subtitle',$posts_page); ?></span>
    <?php endif; ?>
</section>

<section class="main-content revealator-slideup revealator-once revealator-delay1">
    <div class="container">
        <div class="row">
            <!-- Article Starts -->
            <article class="col-12">
                <!-- Meta Starts -->
                <div class="meta open-sans-font">
                    <span><i class="fa fa-user"></i> <?php echo get_the_author_meta('user_nicename',$post->post_author); ?> </span>
                    <span class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span>
                    <span><i class="fa fa-tags"></i> <?php the_tags() ?></span>
                </div>
                <!-- Meta Ends -->
                <!-- Article Content Starts -->
                <h1 class="text-uppercase text-capitalize"><?php the_title(); ?></h1>
                <!-- post thumbnail -->
                <?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
                        <?php the_post_thumbnail(); // Fullsize image for the single post. ?>
                <?php endif; ?>
                <!-- /post thumbnail -->

                <?php the_content(); // Dynamic Content. ?>

                <!-- Article Content Ends -->
            </article>

        </div>
    </div>
</section>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
