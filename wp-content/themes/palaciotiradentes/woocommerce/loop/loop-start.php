<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

$essence = essence_get_global_essence();
$shop_display_style = isset( $essence['woo_shop_display_style'] ) ? trim( $essence['woo_shop_display_style'] ) : 'grid';
$woo_products_per_row = isset( $essence[ 'woo_products_per_row' ] ) ? $essence[ 'woo_products_per_row' ] : '4';


?>
<div class="products tr-products  columns-<?php echo esc_attr( $woo_products_per_row ); ?> products-<?php echo esc_attr( $shop_display_style ); ?> products-wraps">
