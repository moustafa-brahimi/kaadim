
    <div class="modal-searchform" id="modal-searchform">
      
      <?php get_search_form(); ?>


      <button type="button" class="modal-searchform__collapse js-btn-collapse-searchform"  title="<?php esc_attr_e( "Close search form", "rouh" ); ?>">

        <i class="icon fa-solid fa-xmark fa-lg"></i>

      </button>

    </div>

    <footer id="rouh-footer" class="rouh-footer">
      
      <?php get_template_part( "template-parts/footer", "instagram" ); ?>
        
        <div class="rouh-footer__widgets-container" color-scheme="dark">



          <!-- 2/3 -->
          <div class="container">
              <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('rouh-footer-center-widget') ) ?>
          </div>
          <!-- /End 2/3 -->

        </div>

        <div class="rouh-footer__copyrights" >

            <p>

                  <?php
                  echo get_theme_mod( 
                    "rouh_copyright_sentence",
                    sprintf( esc_html__( "All rights reserved to rouh %s", "rouh" ), date('Y') )
                  ); ?>

            </p>

        </div>

    </footer>

  </body>

  <?php wp_footer(); ?>

</html>