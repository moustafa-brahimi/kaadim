<?php
/**
 * @package kadim
 * @since 1.0.0
 * a part to show ads
 */

 ?>

<?php if( isset( $args["mobile"] ) || isset( $args["desktop"] ) ): ?>

    <section class="kadim-ad">

        <?php if( isset( $args["desktop"] ) && ( $desktop_code = get_theme_mod( $args["desktop"], false ) ) ): ?>

            <div class="kadim-ad__desktop">
                <?php echo $desktop_code; ?>
            </div>

        <?php endif; ?>

        
        
        <?php if( isset( $args["mobile"] ) && ( $mobile_code = get_theme_mod( $args["mobile"], false ) ) ): ?>

            <div class="kadim-ad__mobile">
                <?php echo $mobile_code; ?>
            </div>

        <?php endif; ?>

    </section>

<?php endif; ?>