
    <div class="modal-searchform" id="modal-searchform">
      
      <?php get_search_form(); ?>


      <button type="button" class="modal-searchform__collapse js-btn-collapse-searchform">

        <i class="icon fa-solid fa-xmark fa-lg"></i>

      </button>

    </div>

    <footer id="kadim-footer" class="kadim-footer">

      <?php $token = get_theme_mod( "kadim_instagram_account_token", false ); ?>
      

      <?php if( $token ): ?>

        <?php $feed = request( sprintf( "https://graph.instagram.com/me/media?fields=permalink,timestamp,caption,media_url,media_type&access_token=%s", $token ) ); ?>

        <?php $profile = request( sprintf( "https://graph.instagram.com/v16.0/me?fields=username&access_token=%s", $token ) ); ?>

        <?php if( is_array( $feed ) && isset( $feed[ "data" ] ) && is_array( $feed[ "data" ] ) && !empty( $feed[ "data" ] ) ): ?>

          <div class="instagram-grid">

            <?php $i = 0; ?>
  
            <?php while( $i < 5 ): ?>

              <?php foreach( $feed["data"] as $key => $element ): ?>

                <?php $i += 1; ?>
              
                <?php if( $element && isset( $element[ "media_url" ] ) && !empty( $element[ "media_url" ] ) ): ?>

                  <?php $caption = esc_attr( isset( $element["caption"] ) ? $element["caption"] : "" ); ?>

                  <?php if( $element[ "media_type" ] == "IMAGE" ): ?>

                      <div class="instagram-grid__image" title="<?php echo $caption ?>">

                        <a href="<?php echo $element['permalink']; ?>" target="_blank">

                          <img
                            
                            data-loading-method="macro"
                            data-image="<?php esc_attr_e( $element["media_url"] ); ?>"
                            class='image'
                            
                          />
                        </a>

                      </div>


                    <?php elseif( $element[ "media_type" ] == "VIDEO" ): ?>

                      <div class="instagram-grid__video" title="<?php echo $caption ?>">

                        <a href="<?php echo $element['permalink']; ?>" target="_blank">


                          <video class="video js-instagram-videos" preload="none" loop muted>

                            <?php printf( "<source src='%s' >", esc_attr( $element["media_url"] ) ); ?>
                          
                          </video>

                        </a>

                        <button class="video__volume-control js-video-volume">
                            <i class="icon muted-icon fa-solid fa-volume-off"></i>
                            <i class="icon unmuted-icon fa-solid fa-volume-high"></i>
                          </button>

                        <button class="video__play-control js-video-play">
                          <i class="icon play-icon fa-solid fa-fw fa-play"></i>
                          <i class="icon pause-icon fa-solid fa-fw fa-pause"></i>
                        </button>

                      </div>

                  <?php endif; ?>

                  <?php if( $i >= 5 ) { break; } ?>

                <?php endif; ?>
      
              <?php endforeach; ?>

            <?php endwhile; ?>

            <?php 
            
              printf( 
                "<a class='instagram-grid__follow' href='https://www.instagram.com/%s' target='__blank'><span>%s</span></a>",
                $profile['username'],
                __( 'Follow', 'kadim' )
              );
              
            ?>

            <i class="octo octo-instagram-icon js-footer-instagram-icon" size="200"></i>
            <i class="octo octo-instagram-icon octo-instagram-icon__secondary js-footer-instagram-icon" size="200"></i>

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