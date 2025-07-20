<?php 


$current_cat = get_queried_object();
$args = [
    'post_type'     =>  'post',
    'post_status'   =>  'publish',
    'posts_per_page'=>  5,
    'ignore_sticky_posts'   =>  true,
    'meta_key'      =>  '_thumbnail_id',
    'category__in' =>  ( is_category() ? get_queried_object_id()  : get_theme_mod( 'rouh_slider_category', [ 1 ] ) )
];


$query  =   new WP_Query( $args );

?>


<?php $count    =   $query->post_count; ?>


<?php if( $query->have_posts() && $count == 5 ): ?>
    
    <?php $first_post = $query->posts[0]; ?>
    
    <div class="rouh-slider compact-slider <?php if( is_category() ) { echo esc_attr( "compact-slider--category" ); } ?> js-slider-compact" id="rouh-slider">
        
        <div class="container">

            <h3 class="compact-slider__main-title"> 

                <?php $title = esc_html( is_category() ? $current_cat->cat_name : get_theme_mod( "rouh_slider_title", __( 'Featured Posts', 'rouh' ) ) ); ?>
                
                <?php echo $title ?>
                <?php $separator_type=   'wave'; ?>
                <?php $icon_path    =   get_theme_file_path( "assets/dist/img/$separator_type.svg" ); ?>
                <?php $icon         =   file_get_contents( $icon_path ); ?>
                
            </h3>


            <h3 class="compact-slider__main-title-stroke" role="presentation"> 
                
                <?php echo $title; ?>
            
            </h3>

            <div class="compact-slider__container js-slider-compact-container">

                <div class="compact-column">

                    <?php while( $query->current_post < 0 ): $query->the_post(); ?>

                        <?php get_template_part( 'partials/components/post', 'slider-compact', [ 'height' => 'tall' ] ); ?>
                        <?php wp_reset_postdata(); ?>

                    <?php endwhile; ?>

                </div>

                <div class="compact-column">
                    
                    <?php while( $query->current_post < 2 ): $query->the_post(); ?>
                    
                    <?php get_template_part( 'partials/components/post', 'slider-compact', [ 'height' => 'tall' ] ); ?>
                    <?php wp_reset_postdata(); ?>
                    
                    <?php endwhile; ?>
                    
                </div>
                
                
                <div class="compact-column">

                    <?php while( $query->have_posts() ): $query->the_post(); ?>

                        <?php get_template_part( 'partials/components/post', 'slider-compact', [ 'height' => 'tall' ] ); ?>
                        <?php wp_reset_postdata(); ?>

                    <?php endwhile; ?>

                </div>


                <div class="compact-slider__content js-slider-content">


                        <div class='compact-slider__category'>

                            <?php printf( '<a href="%1$s" class="js-slider-category-permalink">', '#' ); ?>

                                <span class="compact-slider__category__name js-slider-category-name" ></span>

                            </a>

                        </div> <!-- slider__category -->

                        <?php $first_post_id = $first_post->ID; ?>


                        <a class="compact-slider__permalink js-slider-permalink" href="<?php echo esc_url( get_the_permalink( $first_post_id ) ); ?>" title="<?php echo esc_attr( get_the_title( $first_post_id ) ); ?>">
                            
                            <h1 class="compact-slider__title js-slider-title">
                                <?php echo esc_html( get_the_title( $first_post_id ) ); ?>
                            </h1>

                        </a><!--  slider__permalink -->

                    
                        <footer class="compact-slider__footer">

                            <div class="compact-slider__footer__container js-slider-footer">

                                <div class="compact-slider__meta">

                                    <a href="#" class="js-slider-author-permalink">

                                        <div class="compact-slider__author ">

                                            <img class="compact-slider__author__avatar js-slider-author-avatar" src=''>

                                            <span class="compact-slider__author__name js-slider-author-name"></span>

                                            
                                        </div> <!-- author -->
                                        
                                    </a>

                                            
                                    <div class='compact-slider__separator' aria-hidden="true">
                                        
                                        <?php $separator_type=   'wave'; ?>
                                        <?php $icon_path    =   get_theme_file_path( "assets/dist/img/$separator_type.svg" ); ?>
                                        <?php $icon         =   file_get_contents( $icon_path ); ?>
                                        
                                        <?php echo $icon; ?>
                                        <?php echo $icon; ?>
                                        
                                    </div> <!-- separator -->
                                        
                                    <time class="compact-slider__date js-slider-date" title="" datetime="" itemprop="datePublished"></time>              
                                    
                                

                                </div> <!-- meta -->


                                    <a class="readmore compact-slider__readmore js-slider-permalink" href="<?php echo esc_url( get_the_permalink( $first_post_id ) ); ?>" title="<?php echo esc_attr( get_the_title( $first_post_id ) ); ?>">
                
                                        <?php $button_text  =   esc_html( __( 'read more', 'rouh' ) ); ?>
                
                                        <span class="readmore__label"> <?php echo $button_text; ?> </span>
                                        <span aria-hidden="true" class="readmore__label readmore__label--secondary"> <?php echo $button_text; ?> </span>
                                        <span aria-hidden="true" class="readmore__label readmore__label--placeholder"> <?php echo $button_text ?> </span>
                                    
                                    </a>
                
                            </div> <!-- footer__container -->

                        </footer>
                        
                </div> <!-- content -->

            </div> <!-- slider__container -->

        </div> <!-- rouh-container -->

    </div> <!-- slider compact -->

    <?php wp_reset_postdata(); ?>

<?php endif; ?>
