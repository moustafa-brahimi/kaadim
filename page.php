<?php 
    
    get_header(); 

?>


<?php if( have_posts() ): ?>

    <div class="container">
        
        <main class="kadim-posts">

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                

                <?php get_template_part( "template-parts/content", "single" ); ?>


            <?php endwhile; ?>

            
        </main>
        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
