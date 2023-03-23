<?php 
    
    get_header(); 

?>


<?php get_template_part( 'partials/slider', 'compact' ); ?>


<?php if( have_posts() ): ?>

    <div class="container">
        
        <main class="kadim-posts" id="kadim-posts">

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                

                <?php get_template_part( "template-parts/content", "post" ); ?>


            <?php endwhile; ?>

            
        </main>

        <button class="kadim-posts__loadmore js-btn-loadmore" >

        <i class="fa-solid fa-ellipsis"></i>

        </button>
        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
