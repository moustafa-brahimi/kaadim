<?php

/**
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
    
    <title><?php bloginfo( 'name' ); ?><?php echo wp_title( "|" ); ?></title>

    <?php wp_head(); ?>

</head>

<body <?php body_class( "kadim" ); ?> color-scheme="dark">

    <?php wp_body_open(); ?>

    <header>

        <?php get_template_part( "template-parts/header", "blog" ); ?>

    </header>