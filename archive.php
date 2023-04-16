<?php 
    get_header(); 
?>

<?php if( have_posts() ): ?>

    <div class="container">
        
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

                        <?php if( is_date() ): ?>

                            <?php esc_html_e( "Date", "kadim" ); ?>
                            
                        <?php elseif( is_tag() ): ?>

                            <?php esc_html_e( "Tag", "kadim" ); ?>

                        <?php endif; ?>

                    </span>

                    <span class="kadim-path__item">
                        <?php wp_title( "" ); ?>
                    </span>

                </div>

                <h1 class="kadim-archive-board__title"><?php wp_title( "" ); ?></h1>


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
