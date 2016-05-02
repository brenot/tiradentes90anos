<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see           http://docs.woothemes.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.2.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$products_per_page = 12;
$essence = essence_get_global_essence();

$woof_settings = get_option( 'woof_settings' );
if ( isset( $woof_settings[ 'per_page' ] ) ) {
    $products_per_page = $woof_settings[ 'per_page' ];
}

$shop_display_style = isset( $essence[ 'woo_shop_display_style' ] ) ? trim( $essence[ 'woo_shop_display_style' ] ) : 'grid';
?>
<form class="woocommerce-ordering" method="get">
    <span class="lable-title"><?php _e( 'Sort By:', 'woocommerce' ); ?></span>
    <select name="orderby" class="orderby">
        <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
            <option
                value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
    // Keep query string vars intact
    foreach ( $_GET as $key => $val ) {
        if ( 'orderby' === $key || 'submit' === $key ) {
            continue;
        }
        if ( is_array( $val ) ) {
            foreach ( $val as $innerVal ) {
                echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
            }
        }
        else {
            echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
        }
    }
    ?>
    <div class="sort-views products-sort-views pull-right">
        <a class="products-grid-view products-change-view <?php echo trim( $shop_display_style ) == 'grid' ? 'active' : ''; ?>"
           href="#"><i class="fa fa-th"></i></a>
        <a class="products-list-view products-change-view <?php echo trim( $shop_display_style ) == 'list' ? 'active' : ''; ?>"
           href="#"><i class="fa fa-th-list"></i></a>
    </div><!-- /.products-sort-views -->
    <div class="sort-number-show pull-right">
        <span class="lable-title"><?php _e( 'Show:', 'woocommerce' ); ?></span>

        <select class="sort-number">
            <option <?php selected( $products_per_page == 4, true ); ?> value="4">4</option>
            <option <?php selected( $products_per_page == 6, true ); ?> value="6">6</option>
            <option <?php selected( $products_per_page == 9, true ); ?> value="9">9</option>
            <option <?php selected( $products_per_page == 12, true ); ?> value="12">12</option>
            <option <?php selected( $products_per_page == 15, true ); ?> value="15">15</option>
        </select>
    </div>
</form>
