<?php 

    $orig_post = $post;
    global $post;
    $tags = wp_get_post_tags($post->ID);

?>


<?php if ($tags): ?>

    <?php 
        
        $tag_ids = array_map( function( $term ) { return $term->term_id; }, $tags );


        $args= [
            'tag__in'   => $tag_ids,
            'post__not_in'  =>  array($post->ID),
            'posts_per_page'    =>  3, // Number of related posts that will be shown.
            'ignore_sticky_posts'   =>  1,
            'meta_key'      =>  '_thumbnail_id',

        ];
        
        $my_query = new wp_query( $args );

    ?> 

    <?php if( $my_query->have_posts() ): ?>
    
        <div class="related-posts">
            
            <h2 class="related-posts__title">
                
                <i class="icon fa-solid fa-fire"></i>
                <?php esc_html_e( "Related Posts", "kadim" ); ?>
            
            </h2>
            
            <ul class="related-posts__list">
            
                <?php while( $my_query->have_posts() ): ?>

                    <?php $my_query->the_post(); ?>
    
                    <li class="related-posts__item">
                        
                        <div class="related-posts__thumbnail">
                            
                            <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
                        
                                <?php the_post_thumbnail( "thumbnail" ); ?>
                        
                            </a>
                        
                        </div>
                            
                        <div class="related-posts__item-content">

                            <h3 class="related-posts__item-title">
                                
                                <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
                                
                                    <?php the_title(); ?>
                            
                                </a>
                            
                            </h3>
                        
                        </div>
                    </li>

                
                <?php endwhile; ?>
            
            </ul>
        
        </div>


    <?php endif; ?>

<?php endif; ?>

<?php 

$post = $orig_post;
wp_reset_query();

?>