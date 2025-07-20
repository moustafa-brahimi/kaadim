<?php 
/**
 * @package rouh
 * @since 1.0
 */
?>

<?php 
    
    get_header(); 

?>



<div class="container">
    
    <div class="rouh-404" id="main">

        <h1 class="rouh-404__title-404">404</h1>
        <h1 class="rouh-404__title"><?php esc_html_e( "Oops ! page not found", "rouh" ); ?></h1>
        <p class="rouh-404__description"><?php esc_html_e( "Sorry, but the page you are looking for was moved, removed, renamed or might never existed...", "rouh" ); ?></p>

        <a class="rouh-404__homelink" href="<?php echo esc_attr( home_url() ); ?>" title="<?php esc_attr_e( "Home", "rouh" ); ?>">
            <?php esc_html_e( "Go back home", "rouh" ); ?>
        </a>

    </div>
    
</div>



<?php get_sidebar(); ?>
<?php get_footer(); ?>
