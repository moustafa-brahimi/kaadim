<?php
/**
 * @package rouh
 * @since 1.0.0
 * a part to show ads
 */

 ?>

<?php $class = ( isset( $args["class"] ) ? esc_attr( $args["class"] ) : "" ); ?>  

<?php if( isset( $args["mobile"] ) || isset( $args["desktop"] ) ): ?>

    <section class="rouh-ad <?php echo $class; ?>">

        <?php if( isset( $args["desktop"] ) && ( $desktop_code = get_theme_mod( $args["desktop"], false ) ) ): ?>

            <div class="rouh-ad__desktop">
                <?php echo $desktop_code; ?>
            </div>

        <?php endif; ?>

        
        
        <?php if( isset( $args["mobile"] ) && ( $mobile_code = get_theme_mod( $args["mobile"], false ) ) ): ?>

            <div class="rouh-ad__mobile">
                <?php echo $mobile_code; ?>
            </div>

        <?php endif; ?>

        <span class="rouh-ad__label"><?php esc_html_e( "Ad", "rouh" ); ?></span>

    </section>

<?php endif; ?>