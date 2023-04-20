<?php 
    get_header(); 
?>

<?php if( have_posts() ): ?>

    <div class="container">

        
        <main class="rouh-posts rouh-author-posts" id="rouh-posts">

            <div class="rouh-archive-board">

                <div class="rouh-archive-board__path rouh-path">

                    <a class="rouh-path__item" 
                        href="<?php echo esc_attr( home_url() ); ?>"
                        title="<?php esc_attr_e( "home", "rouh" ); ?>"
                    >
                        <?php esc_html_e( "Home", "rouh" ); ?>
                    </a>

                    <span class="rouh-path__item">
                        <?php esc_html_e( "Author", "rouh" ); ?>
                    </span>

                    <span class="rouh-path__item">
                        <?php wp_title( "" ); ?>
                    </span>

                </div>


                <?php get_template_part( "template-parts/single/author", "card" ); ?>


            </div>

            <?php
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_author_top_desktop",
                    "mobile"    => "rouh_ads_author_top_mobile",
                    "class"     =>  "author__top"
                ] ); 
            ?>

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>

                <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>

            <?php endwhile; ?>
            
            <?php
            
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_author_bottom_desktop",
                    "mobile"    => "rouh_ads_author_bottom_mobile"
                ] ); 
            
            ?>

            <?php get_template_part( "template-parts/posts", "navigation-links" ); ?>

            
        </main>
        

    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
