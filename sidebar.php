<aside id="sidebar" class="sidebar">

    <div class="sidebar__container">

        <?php 
    
            wp_nav_menu([ 
            
                "theme_location" => "navbar",
                "block" => "sidemenu",
                "container" => "nav",
                "menu_id" => "sidemenu-list",
                "menu_class" => "sidemenu",
                "container_class" => "container sidemenu__container",
                "link_after" => '<i class="sidemenu__dropdown-icon fa-solid fa-caret-down"></i>',
                "walker" => new Bem_Menu_Walker(),
                'fallback_cb' =>  false,

            ]);

        ?>

        <?php dynamic_sidebar( 'kadim-1' ); ?>
                
        <button type="button" class="sidebar__collapse js-btn-collapse-sidebar">

            <i class="icon fa-solid fa-xmark fa-xl"></i>

        </button>


    </div>



</aside>