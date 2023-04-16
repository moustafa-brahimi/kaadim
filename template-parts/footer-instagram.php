
<?php

/**
 * @package kadim
 * @since 1.0
 * footer instagram elemeent
 */

$token = get_theme_mod( "kadim_instagram_account_token", false ); ?>
      

<?php if( $token ): ?>

  <?php $feed = request( sprintf( "https://graph.instagram.com/me/media?fields=permalink,timestamp,caption,media_url,media_type&access_token=%s", $token ) ); ?>

  <?php $profile = request( sprintf( "https://graph.instagram.com/v16.0/me?fields=username&access_token=%s", $token ) ); ?>

  <?php if( is_array( $feed ) && isset( $feed[ "data" ] ) && is_array( $feed[ "data" ] ) && !empty( $feed[ "data" ] ) ): ?>

  <div class="instagram-grid">

    
      <div class="instagram-grid__container" >

        <?php $i = 0; ?>

        <?php while( $i < 5 ): ?>

          <?php foreach( $feed["data"] as $key => $element ): ?>

            <?php $i += 1; ?>
            
            <?php if( $element && isset( $element[ "media_url" ] ) && !empty( $element[ "media_url" ] ) ): ?>

              <?php $caption = esc_attr( isset( $element["caption"] ) ? $element["caption"] : "" ); ?>

              <?php if( $element[ "media_type" ] == "IMAGE" ): ?>

                <div class="instagram-grid__image">

                  <a href="<?php echo $element['permalink']; ?>" target="_blank" title="<?php echo $caption ?>">

                    <img
                        
                      alt = "<?php $caption; ?>"
                      data-loading-method="macro"
                      data-image="<?php esc_attr_e( $element["media_url"] ); ?>"
                      class='image'
                    />

                  </a>

                </div>


              <?php elseif( $element[ "media_type" ] == "VIDEO" ): ?>

                <div class="instagram-grid__video">

                  <a href="<?php echo $element['permalink']; ?>" target="_blank" title="<?php echo $caption ?>">


                    <video class="video js-instagram-videos" preload="none" loop muted title="<?php echo $caption ?>">

                      <?php printf( "<source src='%s' >", esc_attr( $element["media_url"] ) ); ?>
                      
                    </video>

                  </a>

                  <button class="video__volume-control js-video-volume"  title="<?php esc_attr_e( "Mute/Unmute volume", "kadim" ); ?>">
                    <i class="icon muted-icon fa-solid fa-volume-off"></i>
                    <i class="icon unmuted-icon fa-solid fa-volume-high"></i>
                  </button>

                  <button class="video__play-control js-video-play" title="<?php esc_attr_e( "Play/Pause video", "kadim" ); ?>">
                    <i class="icon play-icon fa-solid fa-fw fa-play"></i>
                    <i class="icon pause-icon fa-solid fa-fw fa-pause"></i>
                  </button>

                </div>

              <?php endif; ?>

                <?php if( $i >= 5 ) { break; } ?>

            <?php endif; ?>

          <?php endforeach; ?>

        <?php endwhile; ?>

      </div> <!-- container -->

    <div class="instagram-grid__overflow">

      <i class="octo octo-instagram-icon js-footer-instagram-icon" size="200"></i>
      <i class="octo octo-instagram-icon octo-instagram-icon__secondary js-footer-instagram-icon" size="200"></i>

    </div>

    <a class='kadim-btn instagram-grid__follow'
    href='<?php printf( "https://www.instagram.com/%s", esc_attr( $profile['username'] ) ); ?>' 
    target='__blank'
    title="<?php esc_attr_e( "Follow on instagram", "kadim" ); ?>"
    >
    
      <div class="kadim-btn__container">
        <span class="kadim-btn__label">
        <i class='icon fa-solid fa-square-plus'></i>
        <?php esc_html_e( "Follow on instagram", "kadim" ); ?>
        </span>  

        <span class="kadim-btn__label kadim-btn__label--secondary">
        <i class='icon fa-solid fa-square-plus'></i>
        <?php esc_html_e( "Follow on instagram", "kadim" ); ?>
        </span>  

        <span class="kadim-btn__label kadim-btn__label--placeholder">
        <i class='icon fa-solid fa-square-plus'></i>
        <?php esc_html_e( "Follow on instagram", "kadim" ); ?>
        </span>  

      </div>
    
    </a>


    </div> <!-- instagram grid -->
    
  <?php endif;?>
    
<?php endif; ?>
    