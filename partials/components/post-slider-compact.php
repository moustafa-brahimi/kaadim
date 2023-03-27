<?php 
/**
 * @package evy
 * @since 1.0.0
 * The Parallax Slider Post Template
 */

 ?>


<?php $height   =    ( isset( $args[ 'height' ] ) ? $args[ 'height' ] : 'tall' ); ?>

<article <?php post_class( "compact-post js-slider-item compact-post--$height" ); ?>>

    <?php $post_thumbnail_id    =   get_post_thumbnail_id( $post ); ?>

    <?php $macro                =   get_the_post_thumbnail_url( get_the_ID(), 'kadim-macro' ); ?>

    <?php $full_thumbnail       =   get_the_post_thumbnail_url( get_the_ID(), "kadim-compact-slider-$height" ); ?>

    <?php $thumbnail            =   wp_get_attachment_image( $post_thumbnail_id, "kadim-compact-slider-$height", false, [

        "data-loading-method"   =>  "macro",
        "data-image-macro"      =>  esc_url( $macro ),
        "data-image"            =>  esc_url( $full_thumbnail ),
        "class"                 =>  'compact-post__image image',
        'srcset'                =>  '',

    ] ); ?>

    <?php echo $thumbnail; ?>

    <div class="compact-post__content">


        <?php $post_categroies  =   get_the_category(); ?>
            

        <?php $first_category   =   array_pop( $post_categroies ); ?>

        <?php printf( '<a href="%1$s" class="js-post-category-link">', get_category_link( $first_category ) ); ?>

            <span class='compact-post__category js-post-category'> <?php echo $first_category->name; ?></span>

        </a>

    

        <a class="compact-post__permalink js-post-permalink" href="<?php the_permalink(); ?>" >

            <h3 class="compact-post__title js-post-title"><?php the_title(); ?></h3>

        </a>

                            
            <?php printf( '<a href="%1$s" class="compact-post__author-link js-author-link">', get_the_author_meta( 'user_url' ) ); ?>
                
                    
                    <?php 
                        $author_id  =   get_the_author_meta( 'ID' );
                        $author_name=   get_the_author_meta( 'display_name' );
                    ?>

                    <?php echo get_avatar( $author_id, 36, '', $author_name, [ 'class' => 'js-author-avatar' ] ); ?>
                    
                
                <span class='compact-post__author__name js-author-name'><?php echo esc_html( $author_name ); ?></span>
                    
            </a>

            
            <?php $format   =   get_theme_mod( "evy_slider_post_date_format", 'diffrence' ); ?>

            <?php 
            
            switch( $format ): 

                case 'diffrence':
                    $current_time       =   time();
                    $post_published     =   get_the_date('U');  
                    $date               =   sprintf( esc_html__( '%1$s ago', 'evy' ), human_time_diff( $post_published, $current_time ) );
                break;
                
                case 'custom':
                    $custom_format  =   get_theme_mod( 'evy_slider_post_date_custom_format' );
                    $date           =   get_the_date( $custom_format );

                break;

                default:
                    $date   =   get_the_date( $format );
                break;

            endswitch;

            ?>
            
            
            <time class="compact-post__date js-post-date" title="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
            
                <?php echo esc_html( $date ); ?>
            
            </time>              
        
    </div>

</article>


<!-- ------------------ -->

