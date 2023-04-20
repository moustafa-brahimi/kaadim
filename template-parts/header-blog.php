
<?php get_template_part( "template-parts/notice" ); ?>



<div class="logo">



  <a href='<?php echo esc_url( home_url() ); ?>' > 

    <?php if( has_custom_logo() ): ?>

      <?php $logo_id =  get_theme_mod( "custom_logo", false ); ?>
      <?php $logo_data =  wp_get_attachment_image_src( $logo_id ); ?>
      <?php $logo_src =  array_shift( $logo_data ); ?>
      <?php $logo_width =  array_shift( $logo_data ); ?>
      <?php $logo_height =  array_shift( $logo_data ); ?>
      <?php $dark_mode_logo =  get_theme_mod( "rouh_logo_dark_mode_version", false ); ?>

      <div class="logo__container">

        <?php printf( '<img class="logo__light" src="%s" height="%s" width="%s" alt="%s"/>', $logo_src, $logo_height, $logo_width, esc_attr( get_bloginfo("name") ) ); ?>

        <?php if( $dark_mode_logo ): ?>

          <img src="<?php echo esc_attr( $dark_mode_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo("name") ); ?>" class="logo__dark"/>

        <?php endif; ?>

        </div>

    <?php else: ?>

      <h3 class="logo__alternative"><?php bloginfo( "name" ); ?></h3>

    <?php endif; ?>

      <p class="logo__tagline"><?php bloginfo( "description" ); ?></p>

  </a>


</div>


<div class="navbar">


  <button class="sidemenu-btn js-btn-expand-sidebar" title="<?php esc_attr_e( "Expand side bar", "rouh" ); ?>">

    <i class="sidemenu-btn__icon fa-solid fa-bars"></i>

  </button>

  <button class="search-btn js-btn-expand-searchform" title="<?php esc_attr_e( "Open search form", "rouh" ); ?>">

    <i class="search-btn__icon fa-solid fa-magnifying-glass"></i>

  </button>

  
    <?php 
    
      wp_nav_menu([ 
        
        "theme_location" => "navbar",
        "block" => "menu",
        "container" => "nav",
        "menu_class" => "menu",
        "container_class" => "container navbar__container",
        "link_after" => '<i class="menu__dropdown-icon fa-solid fa-caret-down"></i>',
        "walker" => new Bem_Menu_Walker(),
        'fallback_cb' =>  false,

      ]);

    ?>

    
    <?php get_template_part( "partials/components/button", "color-scheme" ); ?>



</div>




