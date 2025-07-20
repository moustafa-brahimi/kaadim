<?php 
    get_header(); 
?>

    <div class="container">
        
        <main class="rouh-posts" id="main">

            <?php global $wp_query; ?>

            <?php $search_counts = $wp_query->found_posts; ?>

            <div class="rouh-archive-board">

                <div class="rouh-archive-board__path rouh-path">

                    <a class="rouh-path__item" 
                        href="<?php echo esc_attr( home_url() ); ?>"
                        title="<?php esc_attr_e( "home", "rouh" ); ?>"
                    >
                        <?php esc_html_e( "Home", "rouh" ); ?>
                    </a>

                    <span class="rouh-path__item">

                        <?php esc_html_e( "Search :", "rouh" ); ?> <?php echo esc_html( get_query_var( "s", "" ) ); ?>

                    </span>



                </div>

                <h1 class="rouh-archive-board__title">
                    
                    <?php
                    printf(
                        _n( '%d Post found for "%s"', '%d Posts found for "%s"', $search_counts, "rouh" ),
                        $search_counts,
                        esc_html( get_query_var( "s", "" ) )
                    );  ?>
                    
                </h1>

                <p class="something-else"><?php esc_html_e( "Search for something else ?", "rouh" ); ?></p>

                <?php get_search_form(); ?>


            </div>

            <?php
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_search_top_desktop",
                    "mobile"    => "rouh_ads_search_top_mobile"
                ] ); 
            ?>

            <?php if( have_posts() ): ?>

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                
                    <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>

                <?php endwhile; ?>

            <?php endif; ?>

            
            <?php
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_search_bottom_desktop",
                    "mobile"    => "rouh_ads_search_bottom_mobile"
                ] ); 
            ?>

            
            <?php get_template_part( "template-parts/posts", "navigation-links" ); ?>

            
        </main>
        
    </div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
