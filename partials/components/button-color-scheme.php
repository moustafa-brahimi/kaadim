<button class="btn-scheme js-btn-scheme btn-scheme--to-light" title="<?php esc_attr_e( 'Switch Color Scheme', 'evy' ); ?>">

    <span class="btn-scheme__slider">

        <?php printf( 
            
            '<img src="%1s" role="presentation" alt="" class="btn-scheme__planet btn-scheme__planet--sun" />',
            get_theme_file_uri( "assets/dist/img/sun.svg" )
            
        ); ?>

        <?php printf( 
            
            '<img src="%1s" role="presentation" alt="" class="btn-scheme__planet btn-scheme__planet--moon" />',
            get_theme_file_uri( "assets/dist/img/moon.svg" )
            
        ); ?>

    </span>

    <span class="btn-scheme__sky">

        <?php printf( '<img src="%1s" role="presentation" alt="" class="btn-scheme__cloud" />', get_theme_file_uri( "assets/dist/img/cloud1.svg" ) ); ?>
        <?php printf( '<img src="%1s" role="presentation" alt="" class="btn-scheme__cloud" />', get_theme_file_uri( "assets/dist/img/cloud2.svg" ) ); ?>
        <?php printf( '<img src="%1s" role="presentation" alt="" class="btn-scheme__cloud" />', get_theme_file_uri( "assets/dist/img/cloud2.svg" ) ); ?>
        
        <?php for( $i = 0; $i < 5; $i += 1 ): ?>
            <span class="btn-scheme__star"></span>
        <?php endfor; ?>

    </span>

</button>