<?php $post_categroies  =   get_the_category(); ?>
<?php $first_category   =   array_pop( $post_categroies ); ?>
<?php $first_category_url = isset( $first_category ) ? esc_attr( get_term_link( $first_category ) ) : false; ?>

<article <?php post_class( "kadim-single-post" ); ?>>


    <header class="kadim-single-post__header">
        
        <div class="kadim-single-post__path" >

            <a href="<?php bloginfo( "url" ); ?>">
                <span><?php esc_html_e( "Home", "kadim" ); ?></span>
            </a>

            <?php if( $first_category ): ?>

                <a href="<?php echo $first_category_url; ?>">
                    <span><?php echo esc_html( $first_category->name ); ?></span>
                </a>

            <?php endif; ?>

            <span><?php the_title(); ?></span>

        </div>

        <div class="kadim-single-post__stats">

            <?php 

                $current_time       =   time();
                $post_published     =   get_the_date('U');  
                $date               =   sprintf( esc_html__( '%1$s ago', 'evy' ), human_time_diff( $post_published, $current_time ) );

            ?>

            <time class="stat kadim-single-post__reading-time" title="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                <?php echo esc_html( $date ); ?>
            </time>
            

            <span class="stat kadim-single-post__reading-time">
                <i class="icon fa-solid fa-stopwatch"></i>
                <?php echo esc_html( kadim_reading_time() ); ?>

            </span>

            <span class="stat kadim-single-post__comments">
                <i class="icon fa-solid fa-message"></i>
                <?php printf( "%d %s", get_comments_number(), _n( "Comment", "Comments", get_comments_number(), "kadim" ) ); ?>
            </span>

        </div>

    </header>
    

    <?php if( has_post_thumbnail() ): ?>


        <?php $post_thumbnail_id    =   get_post_thumbnail_id( get_the_ID() ); ?>
        <?php $macro                =   get_the_post_thumbnail_url( get_the_ID(), 'kadim-macro' ); ?>
        <?php $full_image           =   get_the_post_thumbnail_url( get_the_ID() ); ?>
        <?php $meta_data            =   wp_get_attachment_metadata( $post_thumbnail_id ); ?>

        <?php $thumbnail            =   wp_get_attachment_image( $post_thumbnail_id, "full", false, [

            "data-loading-method"   =>  "macro",
            "src"                   =>  esc_url( $macro ),
            "data-image-macro"      =>  esc_url( $macro ),
            "data-image"            =>  esc_url( $full_image ),
            "class"                 =>  'image',
            'srcset'                =>  '',

        ] ); ?>

        <div class="kadim-single-post__featured">                        

            <img 

                width = "<?php echo esc_attr( $meta_data[ "width" ] ); ?>"
                height = "<?php echo esc_attr( $meta_data[ "height" ] ); ?>"
                data-loading-method="<?php echo "macro"; ?>"
                data-image-macro="<?php echo esc_attr( $macro ); ?>"
                src="<?php echo esc_attr( $macro ); ?>"
                data-image="<?php echo esc_attr( $full_image ); ?>"
                class="<?php echo 'image'; ?>"


            />


            <?php if( $first_category ): ?>

                <a class="kadim-single-post__featured-category" href="<?php echo $first_category_url; ?>">
                    <?php echo esc_html( $first_category->name ); ?>
                </a>

            <?php endif; ?>

        </div>


    <?php endif; ?>


    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
        <h3 class="post-title kadim-single-post__title"><?php the_title(); ?></h3>
    </a>


    <div class="kadim-single-post__content">

        <?php the_content(); ?>


    </div>




</article>
