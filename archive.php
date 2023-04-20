<?php 
    get_header(); 
?>

<?php if( have_posts() ): ?>

    <div class="container">

        <main class="rouh-posts" id="rouh-posts">

            <div class="rouh-archive-board">

                <div class="rouh-archive-board__path rouh-path">

                    <a class="rouh-path__item" 
                        href="<?php echo esc_attr( home_url() ); ?>"
                        title="<?php esc_attr_e( "home", "rouh" ); ?>"
                    >
                        <?php esc_html_e( "Home", "rouh" ); ?>
                    </a>

                    <span class="rouh-path__item">

                        <?php if( is_date() ): ?>

                            <?php esc_html_e( "Date", "rouh" ); ?>
                            
                        <?php elseif( is_tag() ): ?>

                            <?php esc_html_e( "Tag", "rouh" ); ?>

                        <?php endif; ?>

                    </span>

                    <span class="rouh-path__item">
                        <?php wp_title( "" ); ?>
                    </span>

                </div>

                <h1 class="rouh-archive-board__title"><?php wp_title( "" ); ?></h1>

            </div>

            <?php
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_archive_top_desktop",
                    "mobile"    => "rouh_ads_archive_top_mobile"
                ] ); 
            ?>

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                

                <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>


            <?php endwhile; ?>

            <?php
            get_template_part( "template-parts/ad",  "", [
                "desktop"   => "rouh_ads_archive_bottom_desktop",
                "mobile"    => "rouh_ads_archive_bottom_mobile"
            ] ); 
            ?>


            <?php get_template_part( "template-parts/posts", "navigation-links" ); ?>
            
        </main>



        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
