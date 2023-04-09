
    <div class="modal-searchform" id="modal-searchform">
      
      <?php get_search_form(); ?>


      <button type="button" class="modal-searchform__collapse js-btn-collapse-searchform">

        <i class="icon fa-solid fa-xmark fa-lg"></i>

      </button>

    </div>

    <footer id="kadim-footer" class="kadim-footer">

      <?php $token = "IGQVJWSWxpbzg4aE01QXFrTHhaQnpWWW9HaDZAqa2VlRE5yQjZAqM29rdi1BbnFIenVXSXh1UEJMSzdCOExpdlY0RDRjejhQRzlnZAmxnclFpcWZAVVEg2ZAFNFQ1B6OEpIR3RONUFpUjZAR"; ?>
      <?php $url = "https://api.instagram.com/oauth/access_token"; ?>
      

      <?php if( $token ): ?>

        <?php $feed = request( sprintf( "https://graph.instagram.com/me/media?fields=username,permalink,timestamp,caption,media_url,thumbnail_url&access_token=%s", $token ) ); ?>

        <?php if( is_array( $feed ) && isset( $feed[ "data" ] ) && is_array( $feed[ "data" ] ) && !empty( $feed[ "data" ] ) ): ?>

          <div class="instagram-grid">

            <?php $i = 0; ?>
  
            <?php while( $i < 5 ): ?>

              <?php foreach( $feed["data"] as $key => $element ): ?>

                <?php $i += 1; ?>
              
                <?php if( $element && isset( $element[ "media_url" ] ) && !empty( $element[ "media_url" ] ) ): ?>

                  <div class="instagram-grid__image">

                    <img
                      
                      data-loading-method="macro"
                      data-image="<?php esc_attr_e( $element["media_url"] ); ?>"
                      class='image'
                      
                    />

                  </div>

                  <?php if( $i >= 5 ) { break; } ?>

                <?php endif; ?>
      
              <?php endforeach; ?>

            <?php endwhile; ?>

            <i class="octo octo-instagram-icon" size="420"></i>

          </div>

          
          <?php endif;?>
          
          
        <?php endif; ?>
          
        
        <div class="kadim-footer__widgets-container" color-scheme="dark">



          <!-- 2/3 -->
          <div class="container">
              <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('kadim-footer-center-widget') ) ?>
          </div>
          <!-- /End 2/3 -->

        </div>

        <div class="kadim-footer__copyrights" >

            <p>

                  <?php
                  echo get_theme_mod( 
                    "kadim_copyright_sentence",
                    sprintf( __( "All rights reserved to kadim %s", "kadim" ), date('Y') )
                  ); ?>

            </p>

        </div>

    </footer>

  </body>

  <?php wp_footer(); ?>

</html>