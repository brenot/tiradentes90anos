<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Essence
 */

$essence = essence_get_global_essence();

$secondary_class = essence_shop_secondary_class();
$sidebar_pos = isset( $essence[ 'woo_shop_sidebar_pos' ] ) ? trim( $essence[ 'woo_shop_sidebar_pos' ] ) : 'right';
$enable_single_product_sidebar = isset( $essence[ 'opt_single_product_sidebar' ] ) ? $essence[ 'opt_single_product_sidebar' ] == '1' : false;

$sidebar_pos = is_product() && !$enable_single_product_sidebar ? 'fullwidth' : $sidebar_pos;

?>

<?php if ( $sidebar_pos != 'fullwidth' ): ?>

    <div id="secondary" class="widget-area shop-widget-area <?php echo esc_attr( $secondary_class ); ?>"
         role="complementary">
        <?php if ( is_active_sidebar( 'sidebar-shop' ) ): ?>
            <?php dynamic_sidebar( 'sidebar-shop' ); ?>
        <?php endif; ?>
    </div><!-- #secondary -->

<?php endif; ?>
