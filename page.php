<?php 
    
    get_header(); 

?>


<?php if( have_posts() ): ?>

    <div class="container" id="main">

    <?php
        get_template_part( "template-parts/ad",  "", [
            "desktop"   => "rouh_ads_page_top_desktop",
            "mobile"    => "rouh_ads_page_top_mobile",
            "class"     =>  "single__top"
        ] ); 
    ?>

    <?php while( have_posts() ): ?>

        <?php the_post(); ?>
        
        <?php get_template_part( "template-parts/single/content" ); ?>


    <?php endwhile; ?>

        
    
    <?php
        get_template_part( "template-parts/ad",  "", [
            "desktop"   => "rouh_ads_page_bottom_desktop",
            "mobile"    => "rouh_ads_page_bottom_mobile",
            "class"     =>  "single__bottom"

        ] ); 
    ?>

    </div>

    

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
