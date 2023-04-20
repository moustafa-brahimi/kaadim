<button class="btn-scheme js-btn-scheme btn-scheme--to-light" title="<?php esc_attr_e( 'Switch Color Scheme', 'rouh' ); ?>">

    <span class="btn-scheme__slider">

        <i role="presentation" alt="" class="btn-scheme__planet btn-scheme__planet--sun"></i>
        <i role="presentation" alt="" class="btn-scheme__planet btn-scheme__planet--moon"></i>

    </span>

    <span class="btn-scheme__sky">

        <i alt="" class="btn-scheme__cloud btn-scheme__cloud--style-1" ></i>
        <i alt="" class="btn-scheme__cloud btn-scheme__cloud--style-2" ></i>
        <i alt="" class="btn-scheme__cloud btn-scheme__cloud--style-2" ></i>

        <?php for( $i = 0; $i < 5; $i += 1 ): ?>
            <span class="btn-scheme__star"></span>
        <?php endfor; ?>

    </span>

</button>