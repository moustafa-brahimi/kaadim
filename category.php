<?php 
    
    get_header(); 

?>

<?php if( get_theme_mod( 'kadim_slider_enabled', true ) ): ?>
    <?php get_template_part( 'partials/slider', 'compact' ); ?>
<?php endif; ?>


<?php if( have_posts() ): ?>

    <div class="container">
        
        <?php $current_category = get_queried_object(); ?>


        <main class="kadim-posts" id="kadim-posts">

            <div class="kadim-archive-board">

                <div class="kadim-archive-board__path kadim-path">

                    <a class="kadim-path__item" 
                        href="<?php echo esc_attr( home_url() ); ?>"
                        title="<?php esc_attr_e( "home", "kadim" ); ?>"
                    >
                        <?php esc_html_e( "Home", "kadim" ); ?>
                    </a>

                    <span class="kadim-path__item">

                        <?php if( is_category() ): ?>
                            <?php esc_html_e( "Category", "kadim" ); ?>
                        <?php endif; ?>

                    </span>

                    <span class="kadim-path__item">
                        <?php echo esc_html( $current_category->name ); ?>
                    </span>

                </div>


                <h1 class="kadim-archive-board__title"><?php echo esc_html( $current_category->name ); ?></h1>

                <p class="kadim-archive-board__description"><?php echo esc_html( $current_category->category_description ); ?></p>


            </div>

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                

                <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>


            <?php endwhile; ?>

            
        </main>
        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
