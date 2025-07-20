<?php 
    
    get_header(); 

?>

<?php if( get_theme_mod( 'rouh_slider_enabled', true ) ): ?>
    <?php get_template_part( 'partials/slider', 'compact' ); ?>
<?php endif; ?>


<?php if( have_posts() ): ?>

    <div class="container">

        <?php $current_category = get_queried_object(); ?>

        <main class="rouh-posts" id="main">

            <div class="rouh-archive-board">

                <div class="rouh-archive-board__path rouh-path">

                    <a class="rouh-path__item" 
                        href="<?php echo esc_attr( home_url() ); ?>"
                        title="<?php esc_attr_e( "home", "rouh" ); ?>"
                    >
                        <?php esc_html_e( "Home", "rouh" ); ?>
                    </a>

                    <span class="rouh-path__item">

                        <?php if( is_category() ): ?>
                            <?php esc_html_e( "Category", "rouh" ); ?>
                        <?php endif; ?>

                    </span>

                    <span class="rouh-path__item">
                        <?php echo esc_html( $current_category->name ); ?>
                    </span>

                </div>


                <h1 class="rouh-archive-board__title"><?php echo esc_html( $current_category->name ); ?></h1>

                <p class="rouh-archive-board__description"><?php echo esc_html( $current_category->category_description ); ?></p>


            </div>

            <?php
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_category_top_desktop",
                    "mobile"    => "rouh_ads_category_top_mobile"
                ] ); 
            ?>

            <?php while( have_posts() ): ?>

                <?php the_post(); ?>
                

                <?php get_template_part( "template-parts/content-post",  get_post_format() ); ?>


            <?php endwhile; ?>

            <?php
                get_template_part( "template-parts/ad",  "", [
                    "desktop"   => "rouh_ads_category_bottom_desktop",
                    "mobile"    => "rouh_ads_category_bottom_mobile"
                ] ); 
            ?>

            <?php get_template_part( "template-parts/posts", "navigation-links" ); ?>
            
        </main>


    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
