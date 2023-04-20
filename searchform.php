<?php
/**
 * The searchform.php template.
 *
 * @package rouh
 * @since 1.0.0
 */

$rouh_unique_id = wp_unique_id( 'search-form-' );

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input placeholder=" " inputmode="search" type="search" id="<?php echo esc_attr( $rouh_unique_id ); ?>" class="search-form__field" value="<?php echo get_search_query(); ?>" name="s" />
	<label class="search-form__label" for="<?php echo esc_attr( $rouh_unique_id ); ?>"><?php _e( 'Search&hellip;', 'rouh' ); // phpcs:ignore: WordPress.Security.EscapeOutput.UnsafePrintingFunction -- core trusts translations ?></label>
  <button type="submit" class="search-form__submit" title="<?php esc_attr_e( "Search", "rouh" ); ?>">

    <i class="icon fa-solid fa-magnifying-glass"></i>

  </button>
  
</form>
