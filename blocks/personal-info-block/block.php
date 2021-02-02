<div class="row">
    <div class="col-12">
        <h3 class="text-uppercase custom-title mb-0 ft-wt-600"><?php block_field( 'heading' ); ?></h3>
    </div>
    <div class="col-12 d-block d-sm-none">
        <img src="<?php block_field( 'photo' ); ?>" class="img-fluid main-img-mobile" alt="" />
    </div>
    <div class="col-6">
        <ul class="about-list list-unstyled open-sans-font">
            <li> <span class="title">first name :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'first_name' ); ?></span> </li>
            <li> <span class="title">last name :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'last_name' ); ?></span> </li>
            <?php if (block_value( 'age' )): ?>
            <li> <span class="title">Age :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'age' ); ?></span> </li>
            <?php endif; ?>
            <?php if (block_value( 'nationality' )): ?>
            <li> <span class="title">Nationality :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'nationality' ); ?></span> </li>
            <?php endif; ?>
            <?php if (block_value( 'freelance' )): ?>
            <li> <span class="title">Freelance :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'freelance' ); ?></span> </li>
            <?php endif; ?>
            <?php if (block_value( 'languages' )): ?>
            <li> <span class="title">Languages :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'languages' ); ?></span> </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="col-6">
        <ul class="about-list list-unstyled open-sans-font">
            <li> <span class="title">Address :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'address' ); ?></span> </li>
            <li> <span class="title">phone :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'phone' ); ?></span> </li>
            <li> <span class="title">Email :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'email' ); ?></span> </li>
            <li> <span class="title">Skype :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block"><?php block_field( 'skype' ); ?></span> </li>
        </ul>
    </div>
    <div class="col-12 mt-3">
        <a href="<?php block_field( 'action-link' ); ?>" class="btn btn-download"><?php block_field( 'call-to-action' ); ?></a>
    </div>
</div>