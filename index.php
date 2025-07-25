<?php 
    
    get_header(); 

?>

<?php if( get_theme_mod( 'rouh_slider_enabled', true ) ): ?>
    <?php get_template_part( 'partials/slider', 'compact' ); ?>
<?php endif; ?>


<?php if( have_posts() ): ?>

    <div class="container">
        
        <main class="rouh-posts" id="main">

            <?php
            get_template_part( "template-parts/ad",  "", [
                "desktop"   => "rouh_ads_home_top_desktop",
                "mobile"    => "rouh_ads_home_top_mobile"
            ] ); ?>


            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                
                <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>


            <?php endwhile; ?>

            <?php
            get_template_part( "template-parts/ad",  "", [
                "desktop"   => "rouh_ads_home_bottom_desktop",
                "mobile"    => "rouh_ads_home_bottom_mobile"
            ] ); ?>
            
            <?php get_template_part( "template-parts/posts", "navigation-links" ); ?>


        </main>




        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
