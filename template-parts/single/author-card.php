<?php 

/**
 * @package rouh
 * @since 1.0
 * author card element to show the post author 
 */

 ?>

<section class="author-card">

    <?php $author_id = get_the_author_meta( 'ID' ); ?>
    <?php $author_social_links = get_the_author_meta( "rouh_social_links", $author_id ); ?>
    <?php $author_social_links = is_array($author_social_links) ? $author_social_links: []; ?>
    <?php $author_posts_link = get_author_posts_url( $author_id ); ?>
    <?php $author_name = get_the_author_meta( "display_name", $author_id ); ?>
    <?php $description = get_the_author_meta( "description", $author_id ); ?>

    <?php if( !is_author() ): ?>

        <h2 class="author-card__title">
            <i class="icon fa-solid fa-pen"></i>    
            <?php esc_attr_e( "Written By", "rouh" ); ?>
        </h2>

    <?php endif; ?>

    <div class="author-card__container">

        <div class="author-card__meta">

            <?php echo get_avatar( $author_id, ( is_author() ? 156 : 96 ), '', $author_name, [ 'class' => 'author-card__avatar' ] ); ?>
            
            <div>
            
                <a href="<?php echo esc_attr( $author_posts_link ); ?>" class="author-card__name"><?php echo esc_html( $author_name ); ?></a>

                <nav class="author-card__links">

                    <?php $links_defaults = rouh_user_profile_supported_socials(); ?>

                    <?php foreach( $author_social_links as $index => $link ): ?>

                        <?php $link_info = $links_defaults[ $index ]; ?>

                        <?php if( empty( $link ) ) { continue; } ?>

                        <?php printf(
                            '<a class="author-card__link" href="%s" title="%s" target="_blank"><i class="icon %s"></i></a>',
                            esc_attr($link),
                            esc_attr( $link_info["label"] ),
                            esc_attr( $link_info["faicon"] ) 
                        ); ?>

                    <?php endforeach; ?>

                </nav>

            </div>

        </div>        <p class="author-card__description">

            <?php echo wp_kses_post( $description ); ?>

        </p>

        <?php $author_count = count_user_posts( $author_id ); ?>

        <?php if( $author_count > 0 && !is_author() ): ?>

            <a class="author-card__more" href="<?php echo esc_attr( $author_posts_link ); ?>">
          
                <?php 
                    echo esc_html( 
                        sprintf( 
                            _n( "See %d more Posts written by %s", "See %d more Posts written by %s", $author_count, "rouh" ),
                            $author_count,
                            $author_name
                        )
                    );
                ?>

            </a>

        <?php endif; ?>

    </div>

</section>