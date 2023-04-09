<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$kadim_unique_id = wp_unique_id( 'search-form-' );

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input placeholder=" " inputmode="search" type="search" id="<?php echo esc_attr( $kadim_unique_id ); ?>" class="search-form__field" value="<?php echo get_search_query(); ?>" name="s" />
	<label class="search-form__label" for="<?php echo esc_attr( $kadim_unique_id ); ?>"><?php _e( 'Search&hellip;', 'kadim' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
  <button type="submit" class="search-form__submit">

    <i class="icon fa-solid fa-magnifying-glass"></i>

  </button>
  
</form>
