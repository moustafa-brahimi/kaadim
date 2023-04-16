<?php 
    get_header(); 
?>

    <div class="container">
        
        <main class="kadim-posts" id="kadim-posts">

            <?php global $wp_query; ?>

            <?php $search_counts = $wp_query->found_posts; ?>

            <div class="kadim-archive-board">


                <div class="kadim-archive-board__path kadim-path">

                    <a class="kadim-path__item" 
                        href="<?php echo esc_attr( home_url() ); ?>"
                        title="<?php esc_attr_e( "home", "kadim" ); ?>"
                    >
                        <?php esc_html_e( "Home", "kadim" ); ?>
                    </a>

                    <span class="kadim-path__item">

                        <?php esc_html_e( "Search :", "kadim" ); ?> <?php echo esc_html( get_query_var( "s", "" ) ); ?>

                    </span>



                </div>

                <h1 class="kadim-archive-board__title">
                    
                    <?php
                    printf(
                        _n( '%d Post found for "%s"', '%d Posts found for "%s"', $search_counts, "kadim" ),
                        $search_counts,
                        esc_html( get_query_var( "s", "" ) )
                    );  ?>
                    
                </h1>

                <p class="something-else"><?php esc_html_e( "Search for something else ?", "kadim" ); ?></p>

                <?php get_search_form(); ?>


            </div>

            <?php if( have_posts() ): ?>


            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                
                    <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>

                <?php endwhile; ?>

            <?php endif; ?>


            
        </main>

        
    </div>



<?php get_sidebar(); ?>
<?php get_footer(); ?>
