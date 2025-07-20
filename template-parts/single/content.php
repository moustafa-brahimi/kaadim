
<?php 
/**
 * @package rouh
 * @since 1.0.0
 */

?>

<?php $post_categroies  =   get_the_category(); ?>
<?php $first_category   =   array_pop( $post_categroies ); ?>
<?php $first_category_url = isset( $first_category ) ? esc_attr( get_term_link( $first_category ) ) : false; ?>


<article <?php post_class( "rouh-single-post" ); ?>>

    <?php if( post_password_required() ): ?>

        <div class="rouh-single-post__notice rouh-single-post__notice--warn">

            <i class="icon fa-solid fa-unlock-keyhole"></i>
            
            <?php esc_html_e( "This post is password protected", "rouh" ); ?>

        </div>

    <?php endif; ?>



    <header class="rouh-single-post__header">
        
        <div class="rouh-path" >

            <a class="rouh-path__item" href="<?php echo esc_url( home_url() ) ?>">
                <span><?php esc_html_e( "Home", "rouh" ); ?></span>
            </a>

            <?php if( $first_category ): ?>

                <a class="rouh-path__item" href="<?php echo $first_category_url; ?>">
                    <span><?php echo esc_html( $first_category->name ); ?></span>
                </a>

            <?php endif; ?>

            <span class="rouh-path__item"><?php the_title(); ?></span>

        </div>

        <div class="rouh-single-post__stats">

            <?php 

                $current_time       =   time();
                $post_published     =   get_the_date('U');  
                $date               =   sprintf( esc_html__( '%1$s ago', 'rouh' ), human_time_diff( $post_published, $current_time ) );

            ?>

            <time class="stat rouh-single-post__reading-time" title="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                <?php echo esc_html( $date ); ?>
            </time>
            

            <span class="stat rouh-single-post__reading-time">
                <i class="icon fa-solid fa-stopwatch"></i>
                <?php echo esc_html( rouh_reading_time() ); ?>

            </span>

            <span class="stat rouh-single-post__comments">
                <i class="icon fa-solid fa-message"></i>
                <?php printf( "%d %s", get_comments_number(), _n( "Comment", "Comments", get_comments_number(), "rouh" ) ); ?>
            </span>

        </div>

    </header>
    

    <?php if( has_post_thumbnail() ): ?>


        <?php $post_thumbnail_id    =   get_post_thumbnail_id( get_the_ID() ); ?>
        <?php $macro                =   get_the_post_thumbnail_url( get_the_ID(), 'rouh-macro' ); ?>
        <?php $full_image           =   get_the_post_thumbnail_url( get_the_ID() ); ?>
        <?php $meta_data            =   wp_get_attachment_metadata( $post_thumbnail_id ); ?>

        <div class="rouh-single-post__featured">                        

            <img 

                width = "<?php echo esc_attr( $meta_data[ "width" ] ); ?>" 
                height = "<?php echo esc_attr( $meta_data[ "height" ] ); ?>" 
                data-loading-method="<?php echo "macro"; ?>"                data-image-macro="<?php echo esc_attr( $macro ); ?>" 
                src="<?php echo esc_attr( $macro ); ?>" 
                data-image="<?php echo esc_attr( $full_image ); ?>" 
                class="<?php echo 'image'; ?>" 
                alt="<?php echo esc_attr( $meta_data[ "image_meta" ][ "title" ] ); ?>"



            />


            <?php if( $first_category ): ?>

                <a class="rouh-single-post__featured-category" href="<?php echo $first_category_url; ?>">
                    <?php echo esc_html( $first_category->name ); ?>
                </a>

            <?php endif; ?>

        </div>


    <?php endif; ?>


    <h3 class="post-title rouh-single-post__title"><?php the_title(); ?></h3>

    <div class="rouh-single-post__container">

        <div class="rouh-single-post__content">
            <?php the_content(); ?>
        </div>

        <?php 
            wp_link_pages(
            array(
                'before'   => '<nav class="rouh-single-post__pagination" aria-label="' . esc_attr__( 'Page', 'rouh' ) . '">',
                'after'    => '</nav>',
                'pagelink' => esc_html__( 'Page %', 'rouh' ),
                'separator' => '<i class="icon fa-solid fa-arrow-right"></i>'
                
            )
            );

        ?>

        <?php get_template_part( "template-parts/single/author", "card" ); ?>
        <?php get_template_part( "template-parts/single/related-posts" ); ?>

        <section class="rouh-single-post__comments" >

            <?php comments_template(); ?>

        </section>

    </div><!-- container -->

</article>
