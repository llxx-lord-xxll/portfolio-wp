<div class="resume-box">
    <ul>
        <?php
        if ( !empty(block_value( 'timeline-1' ))) :
        ?>
        <li>
            <div class="icon">
                <?php block_field( 'icon-1' ); ?>
            </div>
            <span class="time open-sans-font text-uppercase"><?php block_field( 'timeline-1' ); ?></span>
            <h5 class="poppins-font text-uppercase"><?php block_field( 'work-title-1' ); ?> <span class="place open-sans-font"><?php block_field( 'company-1' ); ?></span></h5>
            <p class="open-sans-font"><?php block_field( 'description-1' ); ?> </p>
        </li>

        <?php
        endif;
        ?>

        <?php
        if ( !empty(block_value( 'timeline-2' ))) :
            ?>
            <li>
                <div class="icon">
                    <?php block_field( 'icon-2' ); ?>
                </div>
                <span class="time open-sans-font text-uppercase"><?php block_field( 'timeline-2' ); ?></span>
                <h5 class="poppins-font text-uppercase"><?php block_field( 'work-title-2' ); ?> <span class="place open-sans-font"><?php block_field( 'company-2' ); ?></span></h5>
                <p class="open-sans-font"><?php block_field( 'description-2' ); ?> </p>
            </li>

        <?php
        endif;
        ?>

    </ul>
</div>