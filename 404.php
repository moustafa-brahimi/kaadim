<?php 
/**
 * Page Template: test
 */
?>

<?php 
    
    get_header(); 

?>


<?php if( have_posts() ): ?>

    <div class="container">
        
        <div class="kadim-404">

            <h1 class="kadim-404__title-404">404</h1>
            <h1 class="kadim-404__title"><?php esc_html_e( "Oops ! page not found", "kadim" ); ?></h1>
            <p class="kadim-404__description"><?php esc_html_e( "Sorry, but the page you are looking for was moved, removed, renamed or might never existed...", "kadim" ); ?></p>

            <a class="kadim-404__homelink" href="<?php echo esc_attr( home_url() ); ?>" title="<?php esc_html_e( "Home" ); ?>">
                <?php esc_html_e( "Go back home", "kadim" ); ?>
            </a>

        </div>
        
    </div>

<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
