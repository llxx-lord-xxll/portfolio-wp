<section class="container-fluid main-container container-home p-0 revealator-slideup revealator-once revealator-delay1">
    <div class="color-block d-none d-lg-block"></div>
    <div class="row home-details-container align-items-center">
        <div class="col-lg-4 bg position-fixed d-none d-lg-block" style="background-image: url('<?php block_field( 'photo' ); ?>');"></div>
        <div class="col-12 col-lg-8 offset-lg-4 home-details text-left text-sm-center text-lg-left">
            <div>
                <img src="<?php block_field( 'photo' ); ?>" class="img-fluid main-img-mobile d-none d-sm-block d-lg-none" alt="my picture" />
                <h6 class="text-uppercase open-sans-font mb-0 d-block d-sm-none d-lg-block"><?php block_field( 'greeting' ); ?></h6>
                <h1 class="text-uppercase poppins-font"><?php block_field( 'who-am-i' ); ?></h1>
                <p class="open-sans-font"><?php block_field( 'description' ); ?></p>
                <a href="<?php block_field( 'cta-link' ); ?>" class="btn btn-about"><?php block_field( 'cta-text' ); ?></a>
            </div>
        </div>
    </div>
</section>