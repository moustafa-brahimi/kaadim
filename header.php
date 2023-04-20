<?php

/**
 * @package rouh
 * @since 1.0.0
 * 
 * The Header
 * 
 * displays the header section of the website and contains the <head> 
 * 
 */

?>

<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=0.85" />
    <?php wp_head(); ?>

</head>

<body <?php body_class( "rouh" ); ?> color-scheme="dark">

    <?php wp_body_open(); ?>

    <header>

        <?php get_template_part( "template-parts/header", "blog" ); ?>

    </header>