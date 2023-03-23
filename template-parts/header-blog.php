
<?php get_template_part( "template-parts/notice" ); ?>



<div class="logo">



  <a href='<?php echo home_url(); ?>' > 

    <?php if( has_custom_logo() ): ?>

      <?php the_custom_logo(); ?>

    <?php else: ?>

      <h3 class="logo__alternative"><?php bloginfo( "name" ); ?></h3>

    <?php endif; ?>

      <p class="logo__tagline"><?php bloginfo( "description" ); ?></p>

  </a>


</div>


<div class="navbar">


  <button class="sidemenu-btn js-btn-expand-sidebar">

    <i class="sidemenu-btn__icon fa-solid fa-bars"></i>

  </button>

  <button class="search-btn js-btn-expand-searchform" >

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




