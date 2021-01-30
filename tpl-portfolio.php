<?php
/* Template Name: Portfolio Template */

?>
<?php get_header(); ?>
<!-- Page Title Starts -->

        <section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
            <h1><?php echo get_the_title() ?></h1>
            <span class="title-bg"><?php the_field('subtitle'); ?></span>
        </section>

<!-- Page Title Ends -->
<!-- Main Content Starts -->
<section class="main-content text-center revealator-slideup revealator-once revealator-delay1">
    <div id="grid-gallery" class="container grid-gallery">
        <section class="grid-wrap">
            <ul class="row grid">
                <?php

                $args = array(
                    'post_type'=> 'portfolio',
                    'order'    => 'ASC'
                );

                $the_query = new WP_Query( $args );
                if($the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        ?>
                        <!-- Portfolio Item Starts -->
                        <li>
                            <figure>
                                <?php the_post_thumbnail( array( 350, 350 ) ); // Declare pixel size you need inside the array. ?>
                                <div><span><?php the_title(); ?></span></div>
                            </figure>
                        </li>
                        <!-- Portfolio Item Ends -->
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;

                ?>

            </ul>
        </section>
        <!-- Portfolio Grid Ends -->
        <!-- Portfolio Details Starts -->
        <section class="slideshow">
            <ul>

                <?php

                $args = array(
                    'post_type'=> 'portfolio',
                    'order'    => 'ASC'
                );

                $the_query = new WP_Query( $args );
                if($the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        $url = parse_url(get_field('preview_link'));

                        if (isset($url['host']))
                            $url = $url['host'];
                        else
                            $url = '';


                        ?>
                        <li>
                            <figure>
                                <figcaption>
                                    <h3><?php the_title(); ?></h3>
                                    <div class="row open-sans-font">
                                        <div class="col-6 mb-2">
                                            <i class="fa fa-file-text-o pr-2"></i><span class="project-label">Project </span>: <span class="ft-wt-600 uppercase"><?php echo get_the_category_list(','); ?></span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <i class="fa fa-user-o pr-2"></i><span class="project-label">Client </span>: <span class="ft-wt-600 uppercase"><?php the_field('client') ?></span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <i class="fa fa-code pr-2"></i><span class="project-label">Skills </span>: <span class="ft-wt-600 uppercase"><?php echo get_the_tag_list(null,', '); ?></span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <i class="fa fa-external-link pr-2"></i><span class="project-label">Preview </span>: <span class="ft-wt-600 uppercase"><a href="<?php echo $url?get_field('preview_link'):'#'; ?>" target="_blank"><?php echo $url; ?></a></span>
                                        </div>
                                    </div>
                                </figcaption>
                                <!-- Project Details Ends -->
                                <!-- Main Project Content Starts -->
                               <?php the_content(); ?>
                                <!-- Main Project Content Ends -->
                            </figure>
                        </li>
                        <!-- Portfolio Item Detail Ends -->
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;

                ?>

            </ul>
            <nav>
                <span class="icon nav-prev"><img src="<?php echo get_stylesheet_directory_uri() . '/img/left-arrow.png' ?>" alt="previous"></span>
                <span class="icon nav-next"><img src="<?php echo get_stylesheet_directory_uri() . '/img/right-arrow.png' ?>" alt="next"></span>
                <span class="nav-close"><img src="<?php echo get_stylesheet_directory_uri() . '/img/close-button.png' ?>" alt="close"> </span>
            </nav>
            <!-- Portfolio Navigation Ends -->
        </section>
    </div>
</section>
<!-- Main Content Ends -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
