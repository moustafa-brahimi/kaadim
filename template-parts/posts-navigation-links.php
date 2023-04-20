<?php 
/**
 * @package rouh
 * @since 1.0.0 
 */

 ?>

 <section class="posts-navigation-links navigation">
    
    <div class="navigation__older">
        <i class="icon fa-solid fa-left-long"></i>
        <?php previous_posts_link( 
            sprintf( __( "Newer posts", "rouh" ) )
        ); ?>
    </div>
    
    
    <div class="navigation__newer">
        <?php next_posts_link( __( "Older posts", "rouh" ) ); ?>
        <i class="icon fa-solid fa-right-long"></i>
    </div>

 </section>