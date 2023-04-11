<?php 
    
    get_header(); 

?>


<?php if( have_posts() ): ?>

    <div class="container">
        
    <?php while( have_posts() ): ?>

        <?php the_post(); ?>
        
        <?php get_template_part( "template-parts/content", "single" ); ?>


    <?php endwhile; ?>

    
        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
