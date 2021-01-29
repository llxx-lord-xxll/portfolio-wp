<?php
/* Template Name: Contact Template */

?>
<?php get_header(); ?>

        <section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
            <h1><?php echo get_the_title() ?></h1>
            <span class="title-bg"><?php the_field('subtitle'); ?></span>
        </section>

        <!-- Main Content Starts -->
        <section class="main-content revealator-slideup revealator-once revealator-delay1">
            <div class="container">
                <div class="row">
                    <!-- Left Side Starts -->
                    <div class="col-12 col-lg-4">
                        <h3 class="text-uppercase custom-title mb-0 ft-wt-600 pb-3"><?php the_field('heading') ?></h3>
                        <p class="open-sans-font mb-3"> <?php the_field('content') ?></p>
                        <p class="open-sans-font custom-span-contact position-relative">
                            <i class="fa fa-envelope-open position-absolute"></i>
                            <span class="d-block">mail me</span><?php the_field('contact_email') ?>
                        </p>
                        <p class="open-sans-font custom-span-contact position-relative">
                            <i class="fa fa-phone-square position-absolute"></i>
                            <span class="d-block">call me</span><?php the_field('contact_phone') ?>
                        </p>
                        <ul class="social list-unstyled pt-1 mb-5">

                            <?php
                            if( have_rows('socials') ):

                            // loop through the rows of data
                            while ( have_rows('socials') ) : the_row();

                            ?>
                                <li class="facebook">
                                    <a href="<?php the_sub_field('url'); ?>"> <?php the_sub_field('icon'); ?> </a>
                                </li>
                            <?php
                                // display a sub field value


                            endwhile;
                            endif;
                            ?>
                        </ul>
                    </div>
                    <!-- Left Side Ends -->
                    <!-- Contact Form Starts -->
                    <div class="col-12 col-lg-8">
                        <form class="contactform" method="post">
                            <div class="contactform">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="name" placeholder="YOUR NAME">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="email" name="email" placeholder="YOUR EMAIL">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" name="subject" placeholder="YOUR SUBJECT">
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" placeholder="YOUR MESSAGE"></textarea>
                                        <?php wp_nonce_field( 'contact', 'contact_nonce' ); ?>
                                        <input type="hidden" name="action" value="contact">
                                        <button type="submit" class="btn btn-contact">Send Message</button>
                                    </div>
                                    <div class="col-12 form-message">
                                        <span class="output_message text-center font-weight-600 text-uppercase"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form Ends -->
                </div>
            </div>

        </section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
