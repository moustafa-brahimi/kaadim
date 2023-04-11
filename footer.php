
    <div class="modal-searchform" id="modal-searchform">
      
      <?php get_search_form(); ?>


      <button type="button" class="modal-searchform__collapse js-btn-collapse-searchform"  title="<?php esc_attr_e( "Close search form", "kadim" ); ?>">

        <i class="icon fa-solid fa-xmark fa-lg"></i>

      </button>

    </div>

    <footer id="kadim-footer" class="kadim-footer">
      
      <?php get_template_part( "template-parts/footer", "instagram" ); ?>
        
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
                    sprintf( esc_html__( "All rights reserved to kadim %s", "kadim" ), date('Y') )
                  ); ?>

            </p>

        </div>

    </footer>

  </body>

  <?php wp_footer(); ?>

</html>