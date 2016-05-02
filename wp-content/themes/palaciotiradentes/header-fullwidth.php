<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Essence
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php
    wp_head();
    ?>
</head>

<body <?php body_class( essence_get_site_layout() ); ?>>
<div id="main-wraper" class="site-main">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'essence' ); ?></a>
    <div class="main-body">
        <?php get_template_part( 'template-parts/header-layout' ); ?>

        <div id="main-container" class="<?php echo essence_main_container_class(); ?>">
            <div class="site-content-inner container-fluid">
                <div class="row">