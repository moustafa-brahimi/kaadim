<?php 
    
    get_header(); 

?>

<?php if( get_theme_mod( 'kadim_slider_enabled', true ) ): ?>
    <?php get_template_part( 'partials/slider', 'compact' ); ?>
<?php endif; ?>


<?php if( have_posts() ): ?>

    <div class="container">
        
        <main class="kadim-posts" id="kadim-posts">

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                

                <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>


            <?php endwhile; ?>

            
        </main>

        <button 
            title='<?php echo esc_attr_e("Load more", "kadim"); ?>'
            class="kadim-posts__loadmore js-btn-loadmore"
        >

        <i class="fa-solid icon fa-ellipsis"></i>

        </button>
        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
