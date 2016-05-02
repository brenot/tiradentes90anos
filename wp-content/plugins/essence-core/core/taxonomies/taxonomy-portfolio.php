<?php
/**
 * Custom Taxonomies
 * @package  Nella Core 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
  exit;
}

if (!function_exists('north_core_create_taxonomy_portfolio')) {

  function north_core_create_taxonomy_portfolio() {
	// Taxonomy
	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Portfolio Categories', 'essence-core' ),
		'singular_name'              => _x( 'Portfolio Category', 'Portfolio Category', 'essence-core' ),
		'menu_name'                  => __( 'Portfolio Categories', 'essence-core' ),
		'all_items'                  => __( 'All Portfolio Categoties', 'essence-core' ),
		'parent_item'                => '',
		'parent_item_colon'          => '',
		'new_item_name'              => __( 'New Portfolio Category', 'essence-core' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'essence-core' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'essence-core' ),
		'update_item'                => __( 'Update Portfolio Category', 'essence-core' ),
		'search_items'               => __( 'Search Portfolio Category', 'essence-core' ),
		'add_or_remove_items'        => __( 'Add New or Delete Portfolio Category', 'essence-core' ),
		'choose_from_most_used'      => __( 'Choose from most used', 'essence-core' ),
		'not_found'                  => __( 'Portfolio category not found', 'essence-core' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'hierarchical'               => true
	);
	register_taxonomy( 'portfolio_cat', array( 'portfolio' ), $args );
	//flush_rewrite_rules();
  }
  add_action('init', 'north_core_create_taxonomy_portfolio');


	/**
	 * Custom taxonomy Image
	 */
	function ts_taxonomy_edit_meta_field($term) {
		// put the term ID into a variable
		$t_id = $term->term_id;

		// retrieve the existing value(s) for this meta field. This returns an array
		$term_meta = get_option( "taxonomy_$t_id" ); ?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Custom category.', 'essence-core' ); ?></label></th>
			<td>
				<textarea name="term_meta[custom_term_meta]" id="custom_term_meta" ><?php echo $term_meta['custom_term_meta'] ? $term_meta['custom_term_meta'] : ''; ?></textarea>
				<p><?php _e( 'Custom showing category as in Esstinal grid plugin.Add shortcode Esstinal Grid to Category portfolio.', 'essence-core' ); ?></p>
			</td>
		</tr>
		<?php
	}
	function ts_taxonomy_add_new_meta_field() {
		// this will add the custom meta field to the add new term page
		?>
		<div class="form-field">
			<label for="term_meta[custom_term_meta]"><?php _e( 'Custom category.', 'essence-core' ); ?></label>
			<textarea name="term_meta[custom_term_meta]" id="custom_term_meta" ></textarea>

			<p><?php _e( 'Custom showing category as in Esstinal grid plugin.Add shortcode Esstinal Grid to Category portfolio.', 'essence-core' ); ?></p>
		</div>
		<?php
	}
	// Save extra taxonomy fields callback function.
	function save_taxonomy_custom_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	}
	add_action( 'portfolio_cat_add_form_fields', 'ts_taxonomy_add_new_meta_field', 10, 2 );
	add_action( 'portfolio_cat_edit_form_fields', 'ts_taxonomy_edit_meta_field', 10, 2 );
	add_action( 'edited_portfolio_cat', 'save_taxonomy_custom_meta', 10, 2 );
	add_action( 'create_portfolio_cat', 'save_taxonomy_custom_meta', 10, 2 );
}
