<?php 
/**
 * @package rouh
 * @since 1.0.0
 * The Parallax Slider Post Template
 */

 ?>


<?php $height   =    ( isset( $args[ 'height' ] ) ? $args[ 'height' ] : 'tall' ); ?>

<article <?php post_class( "compact-post js-slider-item compact-post--$height" ); ?>>

    <?php $post_thumbnail_id    =   get_post_thumbnail_id( $post ); ?>
    <?php $macro                =   get_the_post_thumbnail_url( get_the_ID(), 'rouh-macro' ); ?>
    <?php $meta_data            =   wp_get_attachment_metadata( $post_thumbnail_id ); ?>

    <?php $full_thumbnail       =   get_the_post_thumbnail_url( get_the_ID(), "rouh-compact-slider-$height" ); ?>

    <img 

        width = "<?php echo esc_attr( $meta_data[ "width" ] ); ?>"
        height = "<?php echo esc_attr( $meta_data[ "height" ] ); ?>"
        data-loading-method="<?php echo "macro"; ?>"
        data-image-macro="<?php echo esc_attr( $macro ); ?>"
        src="<?php echo esc_attr( $macro ); ?>"
        data-image="<?php echo esc_attr( $full_thumbnail ); ?>"
        class="<?php echo 'image'; ?>"
        alt="<?php echo esc_attr( $meta_data[ "image_meta" ][ "title" ] ); ?>" 

    />

    <div class="compact-post__content">


        <?php $post_categroies  =   get_the_category(); ?>
            
        <?php $first_category   =   array_pop( $post_categroies ); ?>

        <?php printf( '<a href="%1$s" class="js-post-category-link">', get_category_link( $first_category ) ); ?>

            <span class='compact-post__category js-post-category'> <?php echo esc_html( $first_category->name ); ?></span>

        </a>

    

        <a class="compact-post__permalink js-post-permalink" href="<?php the_permalink(); ?>" >

            <h1 class="compact-post__title js-post-title"><?php the_title(); ?></h1>

        </a>

                            
            <?php printf( '<a href="%1$s" class="compact-post__author-link js-author-link">', get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>
                
                    
                    <?php 
                        $author_id  =   get_the_author_meta( 'ID' );
                        $author_name=   get_the_author_meta( 'display_name' );
                    ?>

                    <?php echo get_avatar( $author_id, 36, '', $author_name, [ 'class' => 'js-author-avatar' ] ); ?>
                    
                
                <span class='compact-post__author__name js-author-name'><?php echo esc_html( $author_name ); ?></span>
                    
            </a>

            

            <?php 
            
                $current_time       =   time();
                $post_published     =   get_the_date('U');  
                $date               =   sprintf( esc_html__( '%1$s ago', 'rouh' ), human_time_diff( $post_published, $current_time ) );

            ?>
            
            
            <time class="compact-post__date js-post-date" title="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
            
                <?php echo esc_html( $date ); ?>
            
            </time>              
        
    </div>

</article>


<!-- ------------------ -->

