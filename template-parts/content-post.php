<article <?php post_class( "post-card" ); ?>>

<?php if( has_post_thumbnail() ): ?>

    <?php if( is_sticky() ): ?>
        
    <?php endif; ?>

    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">

        <?php $post_thumbnail_id    =   get_post_thumbnail_id( get_the_ID() ); ?>

        <?php $macro                =   get_the_post_thumbnail_url( get_the_ID(), 'rouh-macro' ); ?>
        <?php $full_thumbnail       =   get_the_post_thumbnail_url( get_the_ID(), "rouh-full-width-post-thumbnail" ); ?>

        <?php $meta_data            =   wp_get_attachment_metadata( $post_thumbnail_id ); ?>


        <div class="post-card__thumbnail">                        


            <img 

                width = "<?php echo esc_attr( $meta_data[ "width" ] ); ?>"
                height = "<?php echo esc_attr( $meta_data[ "height" ] ); ?>"
                data-loading-method="<?php echo "macro"; ?>"
                data-image-macro="<?php echo esc_attr( $macro ); ?>"
                src="<?php echo esc_attr( $macro ); ?>"
                data-image="<?php echo esc_attr( $full_thumbnail ); ?>"
                class="<?php echo 'image'; ?>"
                alt="<?php echo $meta_data[ "image_meta" ][ "title" ]; ?>" 


            />

        </div>

    </a>

<?php endif; ?>


<div class="post-card__content">

    <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">

        <h3 class="post-title post-card__title"><?php the_title(); ?></h3>

    </a>

    <div class="post-card__excerpt">

        <?php the_excerpt(); ?>


    </div>

    <header class="post-card__header">

        <?php 

            $current_time       =   time();
            $post_published     =   get_the_date('U');  
            $date               =   sprintf( esc_html__( '%1$s ago', 'rouh' ), human_time_diff( $post_published, $current_time ) );

        ?>

        <time class="post-card__date" title="<?php echo get_the_date(); ?>" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                    
            <?php echo esc_html( $date ); ?>
        
        </time>




        <?php 
            $author_id  =   get_the_author_meta( 'ID' );
            $author_name=   get_the_author_meta( 'display_name' );
        ?>

        <?php printf( '<a href="%1$s" class="post-card__author" title="%s">', get_author_posts_url( $author_id ), esc_attr( $author_name ) ); ?>

            <?php echo get_avatar( $author_id, 36, '', $author_name, [ 'class' => 'js-author-avatar' ] ); ?>
            
            <span class='post__author__name'><?php echo esc_html( $author_name ); ?></span>
                
        </a>

        <?php $tags = get_the_tags(); ?>

        <?php if( $tags ): ?>

            <div class="post-card__tags" >

            
                <span> 

                    <i class="fa-solid fa-tags post-card__tags__icon"></i>
                    <?php _e( 'Tags', 'rouh' ); ?>
                
                </span>

                <ul class='tagslist'>
                
                    <?php for( $i = 0; $i < min( 3, count( $tags ) ); $i += 1 ): ?>

                        <?php printf( "<li class='tagslist__item'><a class='tagslist__link' href='%s'>%s</a></li>", 
                            esc_attr( get_tag_link( $tags[$i]->term_id ) ),
                            esc_html($tags[$i]->name)
                        ); ?>

                    <?php endfor; ?>

                    
                </ul>
                
            </div>
            
        <?php endif; ?>

    </header>

    <button class="post-card__readmore-btn">

        <a class="readmore post-card__readmore" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">

            <?php $button_text  =   esc_html( __( 'Continue reading', 'rouh' ) ); ?>

            <span class="readmore__label"> <?php echo $button_text; ?> </span>
            <span aria-hidden="true" class="readmore__label readmore__label--secondary"> <?php echo $button_text; ?> </span>
            <span aria-hidden="true" class="readmore__label readmore__label--placeholder"> <?php echo $button_text ?> </span>

        </a>

    </button>


</div>


</article>
